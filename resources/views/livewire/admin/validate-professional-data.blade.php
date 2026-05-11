@extends('layouts.app')

@section('content')
    <div class="flex flex-col items-center" style="padding: 0 8px;">
        <x-vitalia-logo class="scale-[0.58] sm:scale-[0.66]" />
    </div>

    <div class="flex items-center gap-2 px-2" style="min-height: 40px;">
        <a href="{{ route('admin.dashboard') }}" class="text-slate-900 flex-shrink-0">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
        <h1 class="text-[18px] sm:text-[22px] font-bold text-slate-900 truncate">Validar de Cédulas</h1>
    </div>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background: #f5f7fa;
            margin: 0;
            padding: 0;
        }

        .admin-container {
            max-width: 100%;
            width: 100%;
            padding: 12px;
            background: #f5f7fa;
            min-height: 100vh;
            padding-bottom: 120px;
        }

        .admin-header {
            margin-bottom: 16px;
        }

        .admin-header h2 {
            margin: 0;
            font-size: 20px;
            color: #1a202c;
            font-weight: 600;
            line-height: 1.3;
        }

        .requests-wrapper {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .request-card {
            background: #fff;
            border-radius: 12px;
            padding: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            border-left: 4px solid #3b82f6;
            transition: transform 0.2s, box-shadow 0.2s;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        .request-card:active {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            gap: 8px;
            flex-wrap: wrap;
        }

        .card-row:last-child {
            margin-bottom: 0;
        }

        .card-label {
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            flex-shrink: 0;
        }

        .card-value {
            font-size: 13px;
            color: #1a202c;
            font-weight: 500;
            flex: 1;
            text-align: right;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        .card-email {
            font-size: 12px;
            color: #64748b;
            margin-bottom: 8px;
            word-break: break-all;
            overflow-wrap: break-word;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-pendiente {
            background: #fef3c7;
            color: #92400e;
        }

        .status-aceptado {
            background: #d1fae5;
            color: #065f46;
        }

        .status-rechazado {
            background: #fee2e2;
            color: #991b1b;
        }

        .card-actions {
            display: flex;
            gap: 8px;
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #e2e8f0;
        }

        .btn-validate {
            flex: 1;
            padding: 11px 12px;
            background: #3b82f6;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            min-height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-validate:active {
            background: #2563eb;
            transform: scale(0.98);
        }

        .btn-validate:disabled {
            background: #cbd5e1;
            color: #94a3b8;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .main-action {
            margin-top: 24px;
            text-align: center;
        }

        .btn-validate-user {
            padding: 12px 32px;
            background: #10b981;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            max-width: 300px;
            transition: background 0.2s;
        }

        .btn-validate-user:active {
            background: #059669;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #64748b;
        }

        .empty-state-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }

        .empty-state-text {
            font-size: 14px;
            line-height: 1.4;
        }

        @media (min-width: 480px) {
            .admin-container {
                padding: 16px;
            }

            .admin-header {
                margin-bottom: 20px;
            }

            .admin-header h2 {
                font-size: 22px;
            }

            .requests-wrapper {
                gap: 12px;
            }

            .request-card {
                padding: 16px;
            }

            .card-label {
                font-size: 12px;
            }

            .card-value {
                font-size: 14px;
            }

            .btn-validate {
                padding: 12px 16px;
                font-size: 14px;
            }
        }

        @media (min-width: 768px) {
            .admin-container {
                max-width: 900px;
                margin: 0 auto;
                padding: 20px;
                padding-bottom: 40px;
            }

            .admin-header {
                margin-bottom: 28px;
            }

            .admin-header h2 {
                font-size: 32px;
            }

            .request-card {
                padding: 20px;
            }

            .card-row {
                margin-bottom: 16px;
            }

            .requests-wrapper {
                gap: 16px;
            }

            .card-label {
                font-size: 12px;
            }

            .card-value {
                font-size: 14px;
            }
        }
    </style>

    <div class="admin-container">

        <div class="requests-wrapper" id="requestsWrapper">
            <div class="empty-state">
                <div class="empty-state-icon">📄</div>
                <div class="empty-state-text">Cargando solicitudes...</div>
            </div>
        </div>
    </div>

    <script>
        (async function() {
            const listUrl = '{{ route('admin.profile.professional.list') }}';
            const viewUrlTemplate = '{{ route('admin.view-professional-data') }}';

            function getStatusText(status) {
                const map = {
                    aceptado: 'Aceptado',
                    rechazado: 'Rechazado',
                    pendiente: 'Pendiente'
                };
                return map[status] || status || 'Pendiente';
            }

            function getStatusClass(status) {
                return 'status-' + (status || 'pendiente');
            }

            async function load() {
                try {
                    const res = await fetch(listUrl, {
                        credentials: 'same-origin'
                    });
                    const json = await res.json();
                    const wrapper = document.querySelector('#requestsWrapper');
                    wrapper.innerHTML = '';

                    const data = json.data || [];
                    if (data.length === 0) {
                        wrapper.innerHTML =
                            '<div class="empty-state"><div class="empty-state-icon">✓</div><div class="empty-state-text">No hay solicitudes pendientes</div></div>';
                        return;
                    }

                    data.forEach(r => {
                        const card = document.createElement('div');
                        card.className = 'request-card';

                        const userName = (r.user && r.user.name) ? r.user.name : 'Usuario';
                        const userEmail = (r.user && r.user.email) ? r.user.email : '';
                        const specialty = r.specialty || '';
                        const status = getStatusText(r.status);

                        const isPending = r.status === 'pendiente';
                        const isDisabled = !isPending;
                        
                        card.innerHTML = `
          <div class="card-email">${userEmail}</div>
          <div class="card-row">
            <span class="card-label">Usuario</span>
            <span class="card-value">${userName}</span>
          </div>
          <div class="card-row">
            <span class="card-label">Especialidad</span>
            <span class="card-value">${specialty}</span>
          </div>
          <div class="card-row">
            <span class="card-label">Estatus</span>
            <span class="status-badge ${getStatusClass(r.status)}">${status}</span>
          </div>
          <div class="card-actions">
            <button class="btn-validate" ${isDisabled ? 'disabled' : ''} onclick="${isDisabled ? '' : `window.location.href='${viewUrlTemplate}?id=${r.id}'`}">
              Validar Usuario
            </button>
          </div>
        `;

                        wrapper.appendChild(card);
                    });
                } catch (e) {
                    const wrapper = document.querySelector('#requestsWrapper');
                    wrapper.innerHTML =
                        '<div class="empty-state"><div class="empty-state-icon">⚠️</div><div class="empty-state-text">Error al cargar solicitudes</div></div>';
                    console.error(e);
                }
            }

            load();
        })();
    </script>

    <x-vitalia-bottom-nav active="home" />
@endsection
