<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'http://cdn.leoh.io/images/base_zero/image_218.jpg',
            'http://cdn.leoh.io/images/base_zero/image_219.jpg',
            'http://cdn.leoh.io/images/base_zero/image_220.jpg',
            'http://cdn.leoh.io/images/base_zero/image_200.jpg',
            'http://cdn.leoh.io/images/base_zero/image_201.jpg',
            'http://cdn.leoh.io/images/base_zero/image_202.jpg',
            'http://cdn.leoh.io/images/base_zero/image_108.jpg',
            'http://cdn.leoh.io/images/base_zero/image_109.jpg',
            'http://cdn.leoh.io/images/base_zero/image_110.jpg',
            'http://cdn.leoh.io/images/base_zero/image_111.jpg',
            'http://cdn.leoh.io/images/base_zero/image_112.jpg',
            'http://cdn.leoh.io/images/base_zero/image_113.jpg',
            'http://cdn.leoh.io/images/base_zero/image_114.jpg',
            'http://cdn.leoh.io/images/base_zero/image_115.jpg',
            'http://cdn.leoh.io/images/base_zero/image_116.jpg',
        ];

        // 生成数据集合
        $users = factory(User::class)
                        ->times(10)
                        ->make()
                        ->each(function ($user, $index)
                            use ($faker, $avatars)
        {
            // 从头像数组中随机取出一个并赋值
            $user->avatar = $faker->randomElement($avatars);
        });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'Summer';
        $user->email = 'summer@example.com';
        $user->avatar = 'http://cdn.leoh.io/images/base_zero/image_218.jpg';
        $user->save();
        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');

        // 将 2 号用户指派为『管理员』
        $user = User::find(2);
        $user->assignRole('Maintainer');

    }
}
