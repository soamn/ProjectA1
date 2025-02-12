<head>
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        /* Make the table more responsive */
        .dataTables_wrapper {
            max-width: 100%;
            overflow-x: auto;
        }
    </style>
</head>

<body class="bg-gray-100">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="bg-white shadow-sm sm:rounded-lg p-5">
            <div class="p-6 text-gray-900">
                {{ __('Welcome ') }} {{ Auth::user()->name }}
            </div>

            <div class="overflow-x-auto">
                <table id="postsTable" class="min-w-full border-collapse rounded-lg">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border px-4 py-2 text-left">S.No.</th>
                            <th class="border px-4 py-2 text-left">Title</th>
                            <th class="border px-4 py-2 text-left">Content</th>
                            <th class="border px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data rows will be populated by DataTable -->
                    </tbody>
                </table>
            </div>
        </div>
    </x-app-layout>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#postsTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 5,
                dom: "ftip",
                ajax: "{{ route('posts.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title'

                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ],
                responsive: true, 
                bLengthChange: true, 
                bInfo: true, 
                bAutoWidth: false 
            });
        });
    </script>
</body>
