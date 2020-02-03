<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        
    }
}
class UsersTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('records')->insert([
        	['name'=>'Nguyen Bac','userId'=>'M01','gender'=>1,'position'=>'Fresher PHP','offic'=>'Tokyo','age'=>20,'startDay'=> Carbon::create('2005', '01', '01'),'Salary'=>'$162,700','Idbike'=>'1A1','Type'=>'pet'],
        	['name'=>'Nguyen Nam','userId'=>'M02','gender'=>1,'position'=>'Fresher Java','offic'=>'Hcm city','age'=>30,'startDay'=> Carbon::create('2004', '01', '02'),'Salary'=>'$86,000','Idbike'=>'1A2','Type'=>'student'],
        	['name'=>'Le Lan','userId'=>'M03','gender'=>0,'position'=>'Accountant','offic'=>'San Francisco','age'=>22,'startDay'=> Carbon::create('2010', '09', '01'),'Salary'=>'$372,000','Idbike'=>'1A3','Type'=>'student'],
        	['name'=>'Nguyen Tay','userId'=>'M04','gender'=>1,'position'=>'Sales Assistant','offic'=>'Tokyo','age'=>32,'startDay'=> Carbon::create('2011', '08', '10'),'Salary'=>'$360,000','Idbike'=>'1A4','Type'=>'worker'],

        	['name'=>'Nguyen Dong','userId'=>'M05','gender'=>1,'position'=>'System Architect','offic'=>'San Francisco','age'=>42,'startDay'=> Carbon::create('2011', '08', '11'),'Salary'=>'$170,000','Idbike'=>'1A5','Type'=>'worker'],
        	['name'=>'Tran Linh','userId'=>'M06','gender'=>0,'position'=>'Senior Javascript Developer','offic'=>'New York','age'=>40,'startDay'=> Carbon::create('2001', '08', '11'),'Salary'=>'$320,000','Idbike'=>'1A6','Type'=>'pet'],

        	['name'=>'Le Phuong','userId'=>'M07','gender'=>0,'position'=>'Accountant','offic'=>'Edinburgh','age'=>22,'startDay'=> Carbon::create('2012', '04', '10'),'Salary'=>'$137,500','Idbike'=>'1A7','Type'=>'woker'],

        	['name'=>'Trieu Man','userId'=>'M08','gender'=>0,'position'=>'System Architect','offic'=>'San Francisco','age'=>42,'startDay'=> Carbon::create('2012', '01', '11'),'Salary'=>'$205,000','Idbike'=>'1A8','Type'=>'student'],
        	['name'=>'Son Tung','userId'=>'M09','gender'=>1,'position'=>'Senior Javascript Developer','offic'=>'New York','age'=>40,'startDay'=> Carbon::create('2001', '08', '11'),'Salary'=>'$170,750','Idbike'=>'1A9','Type'=>'student']

        ]);
	}
}