<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitLaravelAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '初始化 LaravelAdmin 模块';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        //帮助工具
//        $this->callSilent('admin:import', [
//            'extension'=>'helpers'
//        ]);
//        //文件管理
//        $this->callSilent('admin:import',[
//            'extension'=>'media-manager'
//        ]);
//        //配置管理
//        $this->callSilent('admin:import',[
//            'extension'=>'config'
//        ]);
        //计划任务
        try{
            $this->callSilent('admin:import',[
                'extension' => 'scheduling'
            ]);
            return true;
        } catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
