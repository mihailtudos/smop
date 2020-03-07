<?php

namespace App\Imports;

use App\Field;
use App\Role;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        ];

        $columns = array_keys($rules);

        foreach ($rows as $row) {
            foreach ($row as $column => $cellValue) {
                if (in_array($column, $columns) && empty($cellValue)) {
                    continue 2;
                }
            }

            Validator::make($row->toArray(), $rules)->validate();
            //$password = Hash::make(Str::random(8));
            $password = Hash::make('qwerty');

            $user = User::create([
                'name'     => $row['name'],
                'email'    => $row['email'],
                'password' => $password,
            ]);

            $user->fields()->attach(Field::whereName($row['field'])->pluck('id'));
            $user->roles()->attach(Role::whereName($row['role'])->pluck('id'));
        }
    }
}
