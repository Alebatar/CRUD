<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AnimalForm extends Form
{
    public static $rules = [];
    public static $rules_update = null;

    public function buildForm()
    {

      $this->add('name', 'text', [
                    'validation' => 'required',
                    'label' => 'Name',
                    'attr'=> array('style' => 'width: 200px; display:inline-block;', ),
                ])
           ->add('description', 'text', [
                   'validation' => 'required',
                   'label' => 'Description en un mot',
                   'attr'=> array('style' => 'width: 200px; display:inline-block;', ),
                ])
           ->add('type', 'choice', [
                   'empty_value' => '==== Select type ===',
                   'choices'=> $this->data['types'],
                   'validation' => 'required',
                   'label'      => 'Type',
                   'attr'=> array('style' => 'width: 200px; display:inline-block;', ),
                 ]);
      $this->add('submit', 'submit', ['label' => 'Valider', 'attr'=>array('class'=>'btn btn-primary')]);
           //->add('clear', 'reset', ['label' => 'Annuler', 'attr'=>array('class'=>'btn btn-danger')]);
    }
}
