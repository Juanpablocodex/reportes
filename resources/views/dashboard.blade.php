<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="stylesheet" href="{{ asset('CSS/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('toggle-navbar');
            const navbar = document.querySelector('.navbar');
            const content = document.querySelector('.content');
            const homeLink = document.querySelector('.home-link');
            const rolesLink = document.querySelector('.roles-link');
            const statusLink = document.querySelector('.status-link');
            const reportsLink = document.querySelector('.reports-link');
            const sections = document.querySelectorAll('.section');
            const searchInput = document.querySelector('.search-input');
            const reportsTableBody = document.querySelector('.reports-table tbody');

            function showSection(sectionId) {
                sections.forEach(section => section.classList.remove('active'));
                document.getElementById(sectionId).classList.add('active');
                if (sectionId === 'reports-section') {
                    document.querySelector('.new-report-button-container').style.display = 'block';
                } else {
                    document.querySelector('.new-report-button-container').style.display = 'none';
                }
            }

            toggleButton.addEventListener('click', function() {
                navbar.classList.toggle('hidden');
                content.classList.toggle('expanded');
            });

            homeLink.addEventListener('click', function() {
                showSection('dashboard-section');
            });

            rolesLink.addEventListener('click', function() {
                showSection('roles-section');
            });

            statusLink.addEventListener('click', function() {
                showSection('status-section');
            });

            reportsLink.addEventListener('click', function() {
                showSection('reports-section');
            });

            searchInput.addEventListener('input', function() {
                const searchValue = searchInput.value.toLowerCase();
                const rows = reportsTableBody.querySelectorAll('tr');
                rows.forEach(row => {
                    const cell = row.querySelector('td:nth-child(2)');
                    const cellText = cell.textContent.toLowerCase();
                    row.style.display = cellText.includes(searchValue) ? '' : 'none';
                });
            });

            // Mostrar la sección adecuada si hay un parámetro en la URL
            const urlParams = new URLSearchParams(window.location.search);
            const section = urlParams.get('section');
            if (section) {
                showSection(section + '-section');
            } else {
                showSection('dashboard-section');
            }
        });

        function updateRole(userId, role) {
            $.ajax({
                url: `/roles/${userId}`,
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    role: role
                },
                success: function(response) {
                    alert('Rol actualizado con éxito.');
                },
                error: function(xhr) {
                    alert('Ocurrió un error: ' + xhr.responseText);
                }
            });
        }

        function deleteUser(userId) {
            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                $.ajax({
                    url: `/users/${userId}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Usuario eliminado con éxito.');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Ocurrió un error: ' + xhr.responseText);
                    }
                });
            }
        }

        function deleteReport(reportId) {
            if (confirm('¿Estás seguro de que deseas eliminar este reporte?')) {
                $.ajax({
                    url: `/reportes/${reportId}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Reporte eliminado con éxito.');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Ocurrió un error: ' + xhr.responseText);
                    }
                });
            }
        }

        function createNewReport() {
            window.location.href = '{{ route('reportes.create') }}';
        }

        function editReport(reportId) {
            window.location.href = '{{ url('/reportes') }}/' + reportId + '/editar';
        }

        function updateStatus(reportId, estatus) {
            $.ajax({
                url: `/reportes/${reportId}/estatus`,
                method: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    estatus: estatus
                },
                success: function(response) {
                    alert('Estatus actualizado con éxito.');
                },
                error: function(xhr) {
                    alert('Ocurrió un error: ' + xhr.responseText);
                }
            });
        }
    </script>
</head>
<body>
    <div class="toggle-button-container">
        <button id="toggle-navbar">
            <i class="fas fa-bars"></i>
        </button>
    </div>
    <div class="navbar">
        <div class="navbar-content">
            <i class="fas fa-user-circle user-icon"></i>
            <h2>{{ Auth::user()->name }}</h2>
            <h1 style="color: white;">Panel</h1>
            <div class="navbar-footer">
                <div class="link home-link">
                    <i class="fas fa-home"></i> Home
                </div>
                <div class="link roles-link">
                    <i class="fas fa-users-cog"></i> Roles
                </div>
                <div class="link reports-link">
                    <i class="fas fa-file-alt"></i> Reportes
                </div>
                <div class="link status-link">
                    <i class="fas fa-tasks"></i> Estatus
                </div>
            </div>
        </div>
    </div>
    <div class="logout-button-container">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    </div>
    <div class="new-report-button-container" style="display: none;">
        <button class="new-report-button" onclick="createNewReport()">Nuevo Reporte</button>
    </div>
    <div class="content">
        <div id="dashboard-section" class="section">
            <h1>Bienvenido al Panel</h1>
            <img src="{{ asset('CSS/ieu.png') }}" alt="Welcome Image" class="welcome-image">
        </div>
        <div id="roles-section" class="section">
            <h1>Roles</h1>
            <div class="roles-table-container">
                <table class="roles-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>
                                    <select name="role" onchange="updateRole({{ $user->id }}, this.value)">
                                        <option value="sistemas" {{ $user->role == 'sistemas' ? 'selected' : '' }}>Estudiante</option>
                                        <option value="video_vigilancia" {{ $user->role == 'video_vigilancia' ? 'selected' : '' }}>Profesor</option>
                                        <option value="jefe_depto" {{ $user->role == 'jefe_depto' ? 'selected' : '' }}>Administrativo</option>
                                    </select>
                                </td>
                                <td>
                                    <button onclick="deleteUser({{ $user->id }})" class="delete-button">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="status-section" class="section">
            <h1>Estatus</h1>
            <div class="status-table-container">
                <table class="status-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Status</th>
                            <th>Reporte</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportes as $reporte)
                            <tr>
                                <td>{{ $reporte->id }}</td>
                                <td>
                                    <span class="status-circle 
                                        @if($reporte->status == 'solucionado') status-solucionado
                                        @elseif($reporte->status == 'pendiente') status-pendiente 
                                        @elseif($reporte->status == 'sin respuesta') status-sin-respuesta 
                                        @endif">
                                    </span>
                                    {{ $reporte->status }}
                                </td>
                                <td><a href="{{ url('/reportes/pdf', $reporte->id) }}" class="view-pdf-button" target="_blank">Ver PDF</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="reports-section" class="section active">
            <h1>Reportes</h1>
            <div class="reports-search-container">
                <div class="reports-search">
                    <input type="text" class="search-input" placeholder="Buscar...">
                    <button class="search-button"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <div class="reports-table-container">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="reports-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nombre de usuario</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportes as $reporte)
                            <tr>
                                <td>{{ $reporte->id }}</td>
                                <td>{{ $reporte->nombre }}</td>
                                <td>{{ $reporte->fecha }}</td>
                                <td>
                                    <button class="edit-button" onclick="editReport({{ $reporte->id }})">Editar</button>
                                    <form action="{{ route('reportes.destroy', $reporte->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button" onclick="return confirm('¿Estás seguro de que deseas eliminar este reporte?')">Borrar</button>
                                    </form>
                                </td>
                                <td class="status-cell">
                                    <form action="{{ route('reportes.updateStatus', $reporte->id) }}" method="POST" class="status-form">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="solucionado" {{ $reporte->status == 'solucionado' ? 'selected' : '' }}>Solucionado</option>
                                            <option value="pendiente" {{ $reporte->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="sin respuesta" {{ $reporte->status == 'sin respuesta' ? 'selected' : '' }}>Sin Respuesta</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
