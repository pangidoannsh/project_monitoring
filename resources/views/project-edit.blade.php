@extends('layouts.main')
@section('content')
    <div class="px-10 bg-sky-200 py-6">
    <div class="rounded-lg border p-3 bg-white">
        <table class="table-auto w-full">
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
                <tr id="row-edit-{{$data->id}}">
                    <form action="/project/{{$data->id}}" method="post">
                        @method("PUT")
                        @csrf
                        <td class="pr-4">
                            <input value="{{$data->name}}" name="project_name" id="project_name"  type="text" class="border w-full px-2 py-1 text-sm border-slate-500 rounded focus:outline-none focus:ring focus:ring-sky-100 focus:border-sky-500" placeholder="project name">
                        </td>
                        <td class="pr-4">
                            <input  value="{{$data->client}}"  name="client" type="text" class="border w-full px-2 py-1 text-sm border-slate-500 rounded focus:outline-none focus:ring focus:ring-sky-100 focus:border-sky-500 " placeholder="client">
                        </td>
                        <td class="pr-4">
                            <select  name="project_leader" class="border text-sm rounded border-slate-500 focus:ring-blue-500 focus:border-sky-500 block w-full px-2 py-1 focus:ring focus:ring-sky-100">
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}" {{$user->id == $data->leader_id? "selected":""}}>{{$user->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="pr-4">
                            <input  value="{{$data->start_date}}"  name="start_date" type="date" class="border w-full  px-2 py-1 text-sm border-slate-500 rounded focus:outline-none focus:ring focus:ring-sky-100 focus:border-sky-500">
                        </td>
                        <td class="pr-4">
                            <input  value="{{$data->end_date}}" name="end_date" type="date" class="border w-full  px-2 py-1 text-sm border-slate-500 rounded focus:outline-none focus:ring focus:ring-sky-100 focus:border-sky-500">
                        </td>
                        <td class="pr-4">
                            <input  name="progress"  value="{{$data->progress}}" type="number" class="border w-full  px-2 py-1 text-sm border-slate-500 rounded focus:outline-none focus:ring focus:ring-sky-100 focus:border-sky-500">
                        </td>
                        <td class="px-2">
                            <div class="flex gap-2">
                                <button class="rounded bg-yellow-500 py-1 px-2 text-white text-sm btn-update">
                                    <i class="fa fa-check"></i>
                                </button>
                                <a href="/project" class="rounded border border-red-500  py-1 px-2 text-red-500 text-sm btn-cancel-edit">
                                    <i class="fa fa-xmark"></i>
                                </a>
                            </div>
                        </td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
   document.getElementById('project_name').focus();
</script>
@endsection