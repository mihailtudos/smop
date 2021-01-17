<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\User::find(1);

        $admin ->posts()->create([
            'title' => 'Tips for Students: How to Write an Assignment for College',
            'description' => 'When you’re a student, you have to deal with a huge number of classes. On top of everything, your professors also request academic assignments. Without these projects, it’s impossible for you to get a good grade for a particular course.',
            'body' => 'The assignment introduction is a key element that makes your content attractive. It’s the part that defines the direction of the overall assignment, as well as the quality of your research. There are few ways to write an attractive introduction:
                        Provide background on the main issue. If, for example, you’re writing about the potential solutions of obesity, you may briefly introduce the reader into the seriousness of the issue.
                        The introduction must not be overly general. When writing a great assignment, you must focus on the main point from the very beginning.
                        You may also start with a quote or an anecdote. However, it has to be highly relevant to your topic.
                        If this is an essay or another type of assignment that requires a thesis statement, you should position it at the end of the introductory paragraph.
                        An effective conclusion is just as important as the introduction. It’s your final chance to convince the reader that you made a valid point. The conclusion should state the aim and context of your discussion, and briefly summarize its main points. If this is a lengthier project, such as a research paper or dissertation, you may end with suggestions on further research.',
            'image' => 'uploads/banner.jpg',
        ]);
    }
}
