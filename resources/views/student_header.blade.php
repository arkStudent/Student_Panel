<style>
    .top-content{
        background-color: #d9d9d9;
    }
</style>
<div class="container">
    <table border=1 style="border-collapse:collapse;" class="top-content table table-bordered">
        <tbody>
            <tr>
                <td><strong>Name: </strong>{{ session('name') }}</td>
                <td><strong>Student ID: </strong>{{ session('student_id') }}</td>
                <td><strong>Standard: </strong>{{ session('std') }}</td>
                <td><strong>Division: </strong>{{ session('dv') }}</td>
            </tr>
        </tbody>
    </table>
</div>
