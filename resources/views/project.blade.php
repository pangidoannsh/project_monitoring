@extends('layouts.main')
@section('content')
<div class="px-10 bg-sky-200 py-6">
    <div class="rounded-lg border py-6 px-4 bg-white mb-6">
        <h3 class="font-semibold text-2xl mb-4">Tambah Project</h3>
        <form action="/project" method="post">
            @csrf
            <div class="grid grid-cols-12 gap-4">
                <input name="project_name" type="text" placeholder="project name"
                class="border w-full px-2 py-1 text-sm border-slate-500 rounded col-span-2
                focus:outline-none focus:ring focus:ring-sky-100 focus:border-sky-500" >

                <input  name="client" type="text" placeholder="client"
                class="border w-full px-2 py-1 text-sm border-slate-500 rounded focus:outline-none 
                focus:ring focus:ring-sky-100 focus:border-sky-500 col-span-2" >

                <select  name="project_leader" class="border text-sm rounded border-slate-500 col-span-2
                focus:ring-blue-500 focus:border-sky-500 block w-full px-2 py-1 focus:ring focus:ring-sky-100">
                    <option value="null">project leader</option>
                    @foreach ($users as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>

                <input name="start_date" type="date" class="border w-full  px-2 py-1 col-span-2
                text-sm border-slate-500 rounded focus:outline-none focus:ring focus:ring-sky-100 focus:border-sky-500">

                <input name="end_date" type="date" class="border w-full  px-2 py-1 col-span-2
                text-sm border-slate-500 rounded focus:outline-none focus:ring focus:ring-sky-100 focus:border-sky-500">

                <input name="progress" value="0" type="number" class="border w-full  px-2 py-1 text-sm border-slate-500 rounded 
                focus:outline-none focus:ring focus:ring-sky-100 focus:border-sky-500 col-span-1">

                <button class="rounded bg-green-500 py-1 px-2 text-white text-sm" id="btn-save">
                    Tambah
                </button>
            </div>
        </form>
    </div>
    <div class="rounded-lg border p-3 bg-white card">
        <div class="table-responsive">
            <table class="table-auto w-full table-data" id="example">
                <thead>
                    <tr class="bg-slate-100 text-slate-600 uppercase">
                        <th class="text-start font-medium py-2 px-2 w-[20%]">Project Name</th>
                        <th class="text-start font-medium py-2 px-2 w-[15%]">Client</th>
                        <th class="text-start font-medium py-2 px-2 w-[20%]">Project Leader</th>
                        <th class="text-start font-medium py-2 px-2 w-[12%]">Start Date</th>
                        <th class="text-start font-medium py-2 px-2 w-[12%]">End Date</th>
                        <th class="text-start font-medium py-2 px-2 w-[15%]">Progress</th>
                        <th class="text-start font-medium py-2 px-2 w-[5%]">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)  
                        <tr class="text-slate-500 text-sm">
                            <td class="px-2">{{$data->name}}</td>
                            <td class="px-2">{{$data->client}}</td>
                            <td class="px-2" >
                                <div class="flex gap-2">
                                    <div class="flex justify-end">
                                        
                                        @if ($data->leader_photo == null)
                                            <div class="photo-profile w-10 h-10" 
                                                style="background-image: url('{{ asset('storage/photo-profile/default-photo.jpg') }}')">
                                            </div>    
                                        @else
                                            <div class="photo-profile w-10 h-10" 
                                                style="background-image: url('{{ asset('img/photo-profile/'.$data->leader_photo) }}')">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-medium text-slate-600">{{$data->leader_name}}</span>
                                        <span>{{$data->leader_email}}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-2">{{date('d M Y', strtotime($data->start_date))}}</td>
                            <td class="px-2">{{date('d M Y', strtotime($data->end_date))}}</td>
                            <td class="px-2">
                                <div class="flex items-center gap-1">
                                    <div class="progress-bar relative w-[70%] -top-1">
                                        <div class="absolute {{$data->progress < 100 ? "bg-sky-600":"bg-green-600"}} 
                                            z-10 progress-thumb" 
                                        style="width:{{$data->progress}}%"></div>
                                        <div class="absolute {{$data->progress < 100 ? "bg-sky-200":"bg-green-200"}} w-full"></div>
                                    </div>
                                    <span class="font-medium text-slate-600">{{$data->progress}}%</span>
                                </div>
                            </td>
                            <td class="px-2">
                                <div class="flex gap-2">
                                    <form action="/project/delete/{{$data->id}}" method="post">
                                        @csrf
                                        <button class="bg-red-500 py-1 px-2 rounded">
                                            <i class="fa fa-trash text-white "></i>
                                        </button>
                                    </form>
                                    <a href="/project/{{$data->id}}/edit" class="bg-green-500 py-1 px-2 rounded">
                                        <i class="fa fa-pen text-white"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
 $(document).ready(function () {
    $('#example').DataTable();
});
</script>
@endsection