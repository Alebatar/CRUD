<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class AnimalUpdateForm extends Form
{
    public static $rules = [];
    public static $rules_update = null;

    public function buildForm()
    {
      $description = "";
      if($this->data['animal']->getType()->getId() == 1)
      {
         $description = $this->data['animal']->getScale();
      }
      elseif ($this->data['animal']->getType()->getId() == 2)
      {
         $description = $this->data['animal']->getFur();
      }
      elseif ($this->data['animal']->getType()->getId() == 3)
      {
         $description = $this->data['animal']->getFeathers();
      }
      $this->add('name', 'text', [
                    'validation' => 'required',
                    'label' => 'Name',
                    'default_value' => $this->data['animal']->getName(),
                    'attr'=> array('style' => 'width: 200px; display:inline-block;',),
                ])
           ->add('description', 'text', [
                   'validation' => 'required',
                   'label' => 'Description en un mot',
                   'default_value' => $description,
                   'attr'=> array('style' => 'width: 200px; display:inline-block;',),
                ])
           ->add('type', 'choice', [
                   'choices'=> $this->data['types'],
                   'validation' => 'required',
                   'selected' => $this->data['animal']->getType()->getId(),
                   'label'      => 'Type',
                   'attr'=> array('style' => 'width: 200px; display:inline-block;', ),
                 ]);
      $this->add('id', 'hidden', ['default_value'=>$this->data['animal']->getId()]);
      $this->add('submit', 'submit', ['label' => 'Valider', 'attr'=>array('class'=>'btn btn-primary')]);
           //->add('clear', 'reset', ['label' => 'Annuler', 'attr'=>array('class'=>'btn btn-danger')]);
    }
}
