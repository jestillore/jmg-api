<?php

class OAuthClientSeeder extends Seeder {

	public function run() {
       $android = new OAuthClient;
       $android->id = strtoupper(str_random(10));
       $android->secret = str_random(15);
       $android->name = 'JMG Android';
       $android->save();

       $ios = new OAuthClient;
       $ios->id = strtoupper(str_random(10));
       $ios->secret = str_random(15);
       $ios->name = 'JMG IOS';
       $ios->save();

       $basic = new OAuthScope;
       $basic->scope = 'basic';
       $basic->name = 'Basic Scope';
       $basic->description = 'Basic Scope';
       $basic->save();
    }

}