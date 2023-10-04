<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use App\Models\TempFile;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = service::orderBy('created_at', 'DESC');
        if (!empty($request->keyword)) {
            $services  = $services->where('name', 'like', '%' . $request->keyword . '%');
        }
        $services = $services->paginate(5);


        $data['services'] = $services;

        return view('admin.services.list', $data);
    }

    public function create()
    {

        return view('admin.services.create');
    }


    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required',

        ]);

        if ($validator->passes()) {
            //form Validated Succeeessfully

            $service = new Service;
            $service->name = $request->name;
            $service->description = $request->description;
            $service->short_description = $request->short_description;

            $service->status = $request->status;
            $service->save();


            if ($request->image_id > 0) {
                $tempImage = TempFile::where('id', $request->image_id)->first();
                $tempFileName = $tempImage->name;
                $imageArray = explode('.', $tempFileName);
                $ext = end($imageArray);

                $newFileName = 'service-' . $service->id . '.' . $ext;

                $sourcePath = './uploads/temp/' . $tempFileName;

                // Generate Small Thumbnail
                $dPath = './uploads/services/thumb/small/' . $newFileName;
                $img = Image::make($sourcePath);
                $img->fit(360, 220);
                $img->save($dPath);

                // Generate Large Thumbnail
                $dPath = './uploads/services/thumb/large/' . $newFileName;
                $img = Image::make($sourcePath);
                $img->resize(1150, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->save($dPath);
                $service->image = $newFileName;
                $service->save();
                File::delete($sourcePath);     // DELETE TEMP IMAGE


            }

            session()->flash('success', 'Service Created Successfully');

            return response()->json([
                'status' => 200,
                'message' => 'Services Created Successfully',

            ]);
        } else {

            //return errors 
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()

            ]);
        }
    }

    public function edit($id, Request $request)
    {

        $service = Service::where('id', $id)->first();
        // dd($service);
        if (empty($service)) {
            session()->flash('error', 'Record not found in DB ');
            return redirect()->route('servicelist');
        }

        $data['service'] = $service;


        return view('admin.services.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [

            'name' => 'required',

        ]);

        if ($validator->passes()) {
            //form Validated Succeeessfully

            $service = Service::find($id);

            if (empty($service)) {
                session()->flash('error', 'Record not found');
                return response()->json([
                    'status' => 0,


                ]);
            }
            $oldImageName = $service->image;

            $service->name = $request->name;
            $service->description = $request->description;
            $service->short_description = $request->short_description;

            $service->status = $request->status;
            $service->save();


            if ($request->image_id > 0) {
                $tempImage = TempFile::where('id', $request->image_id)->first();
                $tempFileName = $tempImage->name;
                $imageArray = explode('.', $tempFileName);
                $ext = end($imageArray);

                $newFileName = 'service-' . strtotime('now') . '-' . $service->id . '.' . $ext;

                $sourcePath = './uploads/temp/' . $tempFileName;

                // Generate Small Thumbnail
                $dPath = './uploads/services/thumb/small/' . $newFileName;
                $img = Image::make($sourcePath);
                $img->fit(360, 220);
                $img->save($dPath);

                // Delete old small thumbnail
                $sourcePathSmall = './uploads/services/thumb/small/' . $oldImageName;
                File::delete($sourcePathSmall);

                // Generate Large Thumbnail
                $dPath = './uploads/services/thumb/large/' . $newFileName;
                $img = Image::make($sourcePath);
                $img->resize(1150, null, function ($constraint) {
                    $constraint->aspectRatio();
                });


                $img->save($dPath);

                // Delete old large thumbnail
                $sourcePathLarge = './uploads/services/thumb/large/' . $oldImageName;
                File::delete($sourcePathLarge);

                $service->image = $newFileName;
                $service->save();
                File::delete($sourcePathLarge);     // DELETE TEMP IMAGE



            }

            session()->flash('success', 'Service Updated Successfully');

            return response()->json([
                'status' => 200,
                'message' => 'Services Created Successfully',

            ]);
        } else {

            //return errors 
            return response()->json([
                'status' => 0,
                'errors' => $validator->errors()

            ]);
        }
    }


    public function delete()
    {

        echo "delete a Service";
    }
}
