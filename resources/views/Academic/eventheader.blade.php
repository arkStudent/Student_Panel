<style>
    .top-content{
        background-color: #d9d9d9;
    }
</style>
<div class="container mt-3">
    <table border=1 style="border-collapse:collapse;" class="top-content table table-bordered">
        <tbody>
            <tr>
                <td><strong>Branch Name: </strong>{{ session('branch_name') }}</td>
                <td><strong>H.M: </strong>{{ session('hm') }}</td>
                <td><strong>Class Teacher: </strong>{{ session('class_teacher') }}</td>
            </tr>
        </tbody>
    </table>
</div>