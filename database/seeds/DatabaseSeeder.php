<?php

use App\Models\Permission;
use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //New Users
        $jane  = factory(User::class)->create(['name' => 'Jane']);
        $john  = factory(User::class)->create(['name' => 'John']);
        $frank = factory(User::class)->create(['name' => 'Frank']);
        $maria = factory(User::class)->create(['name' => 'Maria']);

        //New Permissions
        $create_user = factory(Permission::class)->create(['name' => 'create-user']);
        $update_user = factory(Permission::class)->create(['name' => 'update-user']);
        $delete_user = factory(Permission::class)->create(['name' => 'delete-user']);

        //New Profiles
        $customer_service = factory(Role::class)->create(['name' => 'customer-service']);
        $team_lead        = factory(Role::class)->create(['name' => 'team-lead']);
        $admin            = factory(Role::class)->create(['name' => 'admin']);
        $customer         = factory(Role::class)->create(['name' => 'customer']);

        //Assign Each Role with Permissions
        $customer_service->allowTo($create_user);
        $customer_service->allowTo($update_user);
        $team_lead->allowTo($update_user);

        //Assign Each User with Profiles
        $jane->assignRoles($customer);
        $john->assignRoles($customer_service);
        $frank->assignRoles($team_lead);
        $maria->assignRoles($admin);
    }
}
