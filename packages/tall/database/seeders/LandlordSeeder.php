<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandlordSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

      $clone = config('database.connections.mysql');
      $clone['database'] = 'landlord';
      \Config::set("database.connections.landlord", $clone);

        $host = \Str::replace("www.",'',request()->getHost());
        $id =  \Ramsey\Uuid\Uuid::uuid4();
        \Tall\Models\Tenant::query()->forceDelete();
        \DB::connection('landlord')->table('tenants')->insert([
          'id' => $id,
          'name' => "Sistema Integrado De Gerenciamento E Administração",
          'slug' => "sistema-integrado-de-gerenciamento-e-administracao",
          'domain'=> $host,
          'email' => "contato@sigasmart.com.br",
          'description' => 'Sistema Integrado De Gerenciamento E Administração',
          'status' => 'published',
          'database' => 'landlord',
          'provider' => 'landlord',
          'middleware' => 'landlord',
          'prefix' => 'landlord',
          'created_at'=>today()->format('Y-m-d H:i:s'),
          'updated_at'=>today()->format('Y-m-d H:i:s')
        ]);
        $tenants =  \DB::connection('backup')->table('companies')->get();
        if($tenants){
          foreach ($tenants as  $tenant) {         
                          
              \DB::connection('landlord')->table('tenants')->insert([
                'id' => \Ramsey\Uuid\Uuid::uuid4(),
                'name' => data_get($tenant,'name'),
                'parent' => data_get($tenant,'id'),
                'user_id' => null,
                'slug' => data_get($tenant,'slug'),
                'domain'=> data_get($tenant,'assets'),
                'email' => data_get($tenant,'email'),
                'prefix' => 'admin',
                'description' => data_get($tenant,'description'),
                'status' => 'published',
                'created_at'=>data_get($tenant,'created_at'),
                'updated_at'=>data_get($tenant,'updated_at'),
            ]);            
          }
        }
      \Tall\Models\UserLandlord::query()->forceDelete();
      $user =   \Tall\Models\UserLandlord::factory()->create([
          'name' => 'Super Admin',
          'email' => 'landlord@example.com',
      ]);
      \App\Models\Role::query()->forceDelete();
      $role =  \App\Models\Role::factory()->create([
          'name' => 'Super Admin',
          'slug' => 'super-admin',
          'special'=>'all-access'
      ]);
      $user->roles()->sync([$role->id->toString()]);
    }
}
