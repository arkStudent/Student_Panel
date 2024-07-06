{{-- tasmiya code  --}}
<style>
    .top-content{
        background-color: #d9d9d9;
    }
</style>
<div class="container">
    <table border=1 style="border-collapse:collapse;" class="top-content table table-bordered">
        <tbody>
            <tr>
                <td><strong>Academic Year: </strong>{{ $academic_year }}</td>
                <td><strong>Fee Category: </strong>{{ implode(', ', $category) }}</td>
                <td><strong>Standard: </strong>{{ session('std') }}</td>
                <td><strong>Division: </strong>{{ session('dv') }}</td>
            </tr>
        </tbody>
    </table>
</div>
