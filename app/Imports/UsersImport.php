<?php

namespace App\Imports;

use App\Field;
use App\Level;
use App\Mail\Users\UserRegisteredByImportMailable;
use App\Mail\Users\UserRegisteredMailable;
use App\Role;
use App\User;
use http\Env\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToCollection, WithHeadingRow
{
    /**
     * @param \Illuminate\Support\Collection $rows
     * @return |null
     */
    public function collection(Collection $rows)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'name'  => 'required|string|min:3',
            'role'  => 'required|string|in:supervisor,student',
            'field' => 'required|exists:' . (new Field())->getTable() . ',name',
            'level' => 'required|exists:' . (new Level())->getTable() . ',name',
        ];

        $columns = array_keys($rules);

        foreach ($rows as $row) {
            foreach ($row as $column => $cellValue) {
                if (in_array($column, $columns) && empty($cellValue)) {
                    continue 2;
                }
            }

            Validator::make($row->toArray(), $rules)->validate();
            $passwordString = Str::random(8);

            $user = User::create([
                'name'     => $row['name'],
                'email'    => $row['email'],
                'password' => Hash::make($passwordString),
            ]);


            $user->fields()->attach(Field::whereName($row['field'])->pluck('id'));
            $user->levels()->attach(Level::whereName($row['level'])->pluck('id'));
            $user->roles()->attach(Role::whereName($row['role'])->pluck('id'));
            $user->profile()->create([]);
            $mailTo[] = ['user' => $user, 'password' => $passwordString];

        }

        foreach ($mailTo as $userAndPassword) {
            Mail::to($userAndPassword['user'])
                ->send(new UserRegisteredByImportMailable($userAndPassword['user'], $userAndPassword['password']));
        }

    }
}
