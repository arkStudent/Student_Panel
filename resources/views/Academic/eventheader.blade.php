<style>
    .top-content{
        background-color: #d9d9d9;
    }
    
    .table th,
    .table td {
        white-space: normal;  
        max-width: 400px;  
    }
 
</style>
<div class="container">
    <table border=1 style="border-collapse:collapse;" class="top-content table table-bordered">
        <tbody>
             
                <tr> 
                    <td><strong>Branch Name: </strong>{{ $branch->name }}</td> 
                    <td><strong>H.M: </strong>{{ $hm }}</td>
                    <td><strong>Class Teacher: </strong>{{ $class_teacher }}</td>
                </tr>
             
        </tbody>
    </table>
</div>

 
