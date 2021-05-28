<?php

namespace App\Controllers;

//MODELS
use App\Models\CommandModel;
use App\Models\CommandLineModel;

// ENTITIES
use App\Entities\Command;
use App\Entities\CommandLine;

class BasketController extends BaseController
{

    public function command()
    {
        $data = [];
        $data['success'] = false;

        $basket = json_decode($this->request->getPost('basket'));

        $commandModel = new CommandModel();
        $commandLineModel = new CommandLineModel();
        $id_user =  $this->session->get('id');

        $newCommand  = new Command();
        $newCommand->fill(
            [
             'state_command' => 'w',
                'fk_id_user' => $id_user
            ]
        );

        $idCommand = $commandModel->insert($newCommand);

        foreach ($basket as $commandLine) {
            $newCommandLine = new CommandLine();
            $newCommandLine->fill([
                'command_quantity' => $commandLine->quantity,
                'fk_id_command' => $idCommand,
                'fk_id_article' => $commandLine->id_article
            ]);
            $commandLineModel->insert($newCommandLine);
        }

        $data['success'] = true;

        header('Content-Type: application/json');
        echo json_encode($data);
        die;
    }

}