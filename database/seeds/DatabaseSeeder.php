<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // $this->call(UsersTableSeeder::class);

        $this->seedBrands();
        $this->seedUsers();
        $this->seedInteraction();

        $this->command->info('Data seeded!');
    }

    private function get_json_data($filename) {

        $api_url = URL::to("/api/load-json/{$filename}");
        $posts = file_get_contents($api_url);

        return json_decode($posts);
    }

    private function seedBrands() {

        $table_name = 'brands';

        $this->command->info('Creating Brands...');

        $json_data = $this->get_json_data($table_name);

        DB::table($table_name)->delete();

        foreach ($json_data as $row) {

            $inserted_brands = DB::table($table_name)->where('id', $row->id)->first();

            if (is_null($inserted_brands)) {
                DB::table($table_name)->insert(
                        array(
                            array(
                                'id' => $row->id,
                                'name' => $row->name,
                                'image' => $row->image,
                            )
                        )
                );
            }
        }
    }

    private function seedUsers() {

        $table_name = 'users';

        $this->command->info("Creating Users...");

        $json_data = $this->get_json_data($table_name);

        DB::table($table_name)->delete();

        foreach ($json_data as $row) {

            $user = DB::table($table_name)->where('id', $row->id)->first();

            if (is_null($user)) {

                DB::table($table_name)->insert(
                        array(
                            array(
                                'id' => $row->id,
                                'gender' => $row->gender,
                                'title' => $row->name->title,
                                'full_name' => $row->name->first . ' ' . $row->name->last,
                                'street' => $row->location->street,
                                'city' => $row->location->city,
                                'state' => $row->location->state,
                                'postcode' => $row->location->postcode,
                                'email' => $row->email,
                                //Login
                                'username' => $row->login->username,
                                'password' => $row->login->md5,
                                //Phone
                                'phone' => $row->phone,
                                'cell' => $row->cell,
                                //Picture
                                'picture_large' => $row->picture->large,
                                'picture_medium' => $row->picture->medium,
                                'picture_thumbnail' => $row->picture->thumbnail,
                                'nat' => $row->nat,
                            )
                ));
            }
        }
    }

    private function seedInteraction() {
        $table_name = 'interactions';

        $this->command->info('Creating Interactions...');

        $json_data = $this->get_json_data($table_name);

        DB::table($table_name)->delete();

        foreach ($json_data as $row) {

            DB::table($table_name)->insert(
                    array(
                        array(
                            'brand_id' => $row->brand,
                            'user_id' => $row->user,
                            'interaction_type' => $row->type,
                            'note' => $row->text
                        )
                    )
            );
        }
    }

}

/*
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(['email' => 'foo@bar.com']);
    }

}
*/