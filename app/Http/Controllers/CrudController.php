<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Entities\Animal;
use Illuminate\Http\Request;
use App\Repositories\AnimalRepository as animalRepo;
use LaravelDoctrine\ORM\Facades\EntityManager;
use Kris\LaravelFormBuilder\FormBuilder;

class CrudController extends Controller
{
    private $AnimalRepository;

    public function __construct(animalRepo $repo)
    {
        $this->AnimalRepository = $repo;
    }

    public function index(FormBuilder $formBuilder)
    {
        $animals = EntityManager::getRepository('App\Entities\Animal')->findAll();
        $types = EntityManager::getRepository('App\Entities\Type')->findAll();
        $types_tab = array();
        foreach ($types as $type) {
          $types_tab[$type->getId()] = $type->getLibelle();
        }
        $form = $formBuilder->create('App\Forms\AnimalForm', [
            'method' => 'POST',
            'url' => route('add'),
            'data'=>array('types'=>$types_tab),
        ]);
        $url_update = route('update', ['id'=>0]);
        $url_delete = route('delete', ['id'=>0]);
        $array = array_merge(['animals'=>$animals, 'url_update'=>$url_update, 'url_delete'=>$url_delete],compact('form'));
        return view('crud.index', $array);
    }

    public function create(Request $request)
    {
        $type = EntityManager::getRepository('App\Entities\Type')->findOneBy(array('id'=>$request->input('type')));
        $name = $request->input('name');
        $description = $request->input('description');
        // It will automatically use current request, get the rules, and do the validation
        if (is_null($type) || is_null($name) || is_null($description)) {
             return redirect()->back()->withErrors(221)->withInput();
         }
         $animal = new Animal();
         $animal->setName($name);
         $animal->setType($type);
         if($type->getId() == 1)
         {
           $animal->setScale($description);
         }
         elseif($type->getId() == 2)
         {
           $animal->setFur($description);
         }
         elseif($type->getId() == 3)
         {
           $animal->setFeathers($description);
         }
         $this->AnimalRepository->save($animal);
         return redirect()->route('home');
    }

    public function update(FormBuilder $formBuilder, $id)
    {
        $animal = EntityManager::getRepository('App\Entities\Animal')->findOneBy(array('id'=>$id));
        $types = EntityManager::getRepository('App\Entities\Type')->findAll();
        $types_tab = array();
        foreach ($types as $type) {
          $types_tab[$type->getId()] = $type->getLibelle();
        }
        $form = $formBuilder->create('App\Forms\AnimalUpdateForm', [
            'method' => 'POST',
            'url' => route('validateUpdate'),
            'data'=>array('types'=>$types_tab, 'animal'=>$animal),
        ]);
        return view('crud.updateForm', compact('form'));
    }

    public function validateUpdate(Request $request)
    {
        $animal = EntityManager::getRepository('App\Entities\Animal')->findOneBy(array('id'=>$request->input('id')));
        $type = EntityManager::getRepository('App\Entities\Type')->findOneBy(array('id'=>$request->input('type')));
        $name = $request->input('name');
        $description = $request->input('description');
        // It will automatically use current request, get the rules, and do the validation
        if (is_null($type) || is_null($name) || is_null($description) || is_null($animal)) {
             return redirect()->back()->withErrors(221)->withInput();
         }
         $animal->setName($name);
         $animal->setType($type);
         if($type->getId() == 1)
         {
           $animal->setScale($description);
         }
         elseif($type->getId() == 2)
         {
           $animal->setFur($description);
         }
         elseif($type->getId() == 3)
         {
           $animal->setFeathers($description);
         }
         $this->AnimalRepository->save($animal);
         return redirect()->route('home');
    }

    public function delete(Request $request, $id)
    {
       $animal = EntityManager::getRepository('App\Entities\Animal')->findOneBy(array('id'=>$id));
       if (is_null($animal)) {
            return redirect()->back()->withErrors(221)->withInput();
       }
       $this->AnimalRepository->delete($animal);
       return redirect()->route('home');
    }
}
