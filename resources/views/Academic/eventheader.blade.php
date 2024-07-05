<style>
    .top-content{
        background-color: #d9d9d9;
    }
</style>
<div class="container">
    <table border=1 style="border-collapse:collapse;" class="top-content table table-bordered">
        <tbody>
            
                {{-- <td><strong>Branch ID: </strong>{{ $branch->id }}</td> 
                <td><strong>Branch Name: </strong>{{ session('branch_id') }}</td>
                  <td><strong>H.M: </strong>{{ session('hm') }}</td>
                <td><strong>Class Teacher: </strong>{{ session('class_teacher') }}</td> --}}
                <tr> 
                    <td><strong>Branch Name: </strong>{{ $branch->sname }}</td> 
                    <td><strong>H.M: </strong>{{ $hm }}</td>
                    <td><strong>Class Teacher: </strong>{{ $class_teacher }}</td>
                </tr>
             
        </tbody>
    </table>
</div>

 
