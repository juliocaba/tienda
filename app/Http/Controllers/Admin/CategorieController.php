<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\CategorieDataTable;
use App\Http\Requests\Admin;
use App\Http\Requests\Admin\CreateCategorieRequest;
use App\Http\Requests\Admin\UpdateCategorieRequest;
use App\Repositories\Admin\CategorieRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use App\Models\Admin\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class CategorieController extends AppBaseController
{
    /** @var  CategorieRepository */
    private $categorieRepository;

    public function __construct(CategorieRepository $categorieRepo)
    {
        $this->categorieRepository = $categorieRepo;
    }

    /**
     * Display a listing of the Categorie.
     *
     * @param CategorieDataTable $categorieDataTable
     * @return Response
     */
    public function index(CategorieDataTable $categorieDataTable)
    {
        
        return $categorieDataTable->render('admin.categories.index');
    }
    
    public function welcomeIndex(){
        $categorias = $this->categorieRepository->all();
       /*  $categorias = DB::table('categories')->pluck('id','name'); */
        return view('welcome',compact('categorias'));
    }
    /**
     * Show the form for creating a new Categorie.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created Categorie in storage.
     *
     * @param CreateCategorieRequest $request
     *
     * @return Response
     */
    public function store(CreateCategorieRequest $request)
    {
        $input = $request->all();

        $categorie = $this->categorieRepository->create($input);
        /*  */
        if (!is_null($request->file('file'))) {
            $archivo=$request->file('file');
            $filename = explode(".", $archivo->getClientOriginalName());
                $fileExtension = $filename[count($filename)-1];
            $nombre_archivo = md5($categorie->id.$archivo->getClientOriginalName()).'.'.$fileExtension;
            $archivo->storeAs(
                '/upload/categories/',
                $nombre_archivo,
                'public'
            );
            //Guardo el nuevo url en la BD
            DB::table('Categories')->where('id', $categorie->id)->update([
                'image' => 'storage/upload/categories/'.$nombre_archivo            
            ]);
        }
        /*  */
        Flash::success('Categorie saved successfully.');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Display the specified Categorie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categorie = $this->categorieRepository->find($id);

        if (empty($categorie)) {
            Flash::error('Categorie not found');

            return redirect(route('admin.categories.index'));
        }

        return view('admin.categories.show')->with('categorie', $categorie);
    }

    /**
     * Show the form for editing the specified Categorie.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categorie = $this->categorieRepository->find($id);

        if (empty($categorie)) {
            Flash::error('Categorie not found');

            return redirect(route('admin.categories.index'));
        }

        return view('admin.categories.edit')->with('categorie', $categorie);
    }

    /**
     * Update the specified Categorie in storage.
     *
     * @param  int              $id
     * @param UpdateCategorieRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategorieRequest $request)
    {
        $categorie = $this->categorieRepository->find($id);

        if (empty($categorie)) {
            Flash::error('Categorie not found');

            return redirect(route('admin.categories.index'));
        }

        $categorie = $this->categorieRepository->update($request->all(), $id);
        $input = $request->all();
        /*  */
        if (!is_null($request->file('file'))) {
            $archivo=$request->file('file');
            $filename = explode(".", $archivo->getClientOriginalName());
                $fileExtension = $filename[count($filename)-1];
            $nombre_archivo = md5($categorie->id.$archivo->getClientOriginalName()).'.'.$fileExtension;
            $archivo->storeAs(
                '/upload/categories/',
                $nombre_archivo,
                'public'
            );
            //Guardo el nuevo url en la BD
            DB::table('Categories')->where('id', $categorie->id)->update([
                'image' => 'storage/upload/categories/'.$nombre_archivo            
            ]);
        }
        /*  */
        Flash::success('Categorie updated successfully.');

        return redirect(route('admin.categories.index'));
    }

    /**
     * Remove the specified Categorie from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categorie = $this->categorieRepository->find($id);

        if (empty($categorie)) {
            Flash::error('Categorie not found');

            return redirect(route('admin.categories.index'));
        }

        $this->categorieRepository->delete($id);

        Flash::success('Categorie deleted successfully.');

        return redirect(route('admin.categories.index'));
    }
}
