@extends('layouts.main')
@section('content')
<div class="px-10 bg-sky-200 py-6 grid grid-cols-6 gap-6">
    <div class="rounded-lg border py-6 px-4 bg-white mb-6 col-span-2">
        <h3 class="font-semibold text-2xl mb-4">Tambah Leader</h3>
        <form action="/users" method="post" enctype="multipart/form-data">
            @csrf
            <input name="name" type="text" placeholder="leader name"
            class="border w-full px-2 py-1 border-slate-500 rounded 
            focus:outline-none focus:ring focus:ring-sky-100 focus:border-sky-500" >

            <input name="email" type="email" placeholder="email"
            class="border w-full px-2 py-1 border-slate-500 rounded my-2 
            focus:outline-none focus:ring focus:ring-sky-100 focus:border-sky-500" >

            <div class="relative mb-6" style="height: 96px" id="upload-field">
                <label for="photo" class="absolute w-full py-4 border text-center text-slate-400 top-0 left-0 cursor-pointer">
                    <div class="flex flex-col items-center">
                        <i class="fa fa-camera text-2xl"></i>
                        <span>Pilih Foto</span>
                    </div>
                </label>
                <input type="file" class="hidden absolute" id="photo" name="photo">
            </div>
            <div class="w-full overflow-hidden px-4 text-center" id="photo-area">
                <img src="#" id="preview-photo" class="w-full" alt="">
            </div>
            <button class="rounded bg-green-500 p-2 text-white hover:bg-green-600 active:ring active:ring-green-200">
                Tambah
            </button>
        </form>
    </div>
    <div class="rounded-lg border p-3 bg-white card col-span-4">
        <div class="table-responsive">
            <table class="table-auto w-full table-data" id="example">
                <thead>
                    <tr class="bg-slate-100 text-slate-600 uppercase">
                        <th class="text-start font-medium py-2 px-2 w-[20%]">Leader Name</th>
                        <th class="text-start font-medium py-2 px-2 w-[15%]">Email</th>
                        <th class="text-start font-medium py-2 px-2 w-[5%]">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)  
                        <tr class="text-slate-500 text-sm">
                            <td class="px-2">{{$user->name}}</td>
                            <td class="px-2">{{$user->email}}</td>
                            <td class="px-2">
                                <div class="flex gap-2">
                                    <form action="/project/delete/{{$user->id}}" method="post">
                                        @csrf
                                        <button class="bg-red-500 py-1 px-2 rounded">
                                            <i class="fa fa-trash text-white"></i>
                                        </button>
                                    </form>
                                    <a href="/project/{{$user->id}}/edit" class="bg-green-500 py-1 px-2 rounded">
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
    const inputPhoto = document.getElementById("photo");
    const previewPhoto = document.getElementById("preview-photo")

    inputPhoto.onchange = () => {
        const uploadField = document.getElementById("upload-field");
        const photoArea = document.getElementById("photo-area");
        photoArea.classList.add("border");
        photoArea.classList.add("mb-6");
        uploadField.classList.add("hidden");
        let reader = new FileReader();
        reader.readAsDataURL(inputPhoto.files[0]);
        reader.onload = ()=>{
            previewPhoto.setAttribute('src',reader.result);
        }
    }
</script>
<script>
 $(document).ready(function () {
    $('#example').DataTable();
});
</script>
@endsection