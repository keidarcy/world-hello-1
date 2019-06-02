<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Questionnaire;

class ChangeQuestionnaireStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $questionnaires =Questionnaire::get();

        foreach($questionnaires as $questionnaire)
        {
          if($questionnaire->answering_end_time && $questionnaire->answering_end_time < date('Y-m-d H:i:s'))
          {
            $questionnaire->mtb_questionnaire_status_id = 3;
            $questionnaire->save();
          }

        }
    }
}
