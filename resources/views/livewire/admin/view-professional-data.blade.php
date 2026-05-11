@extends('layouts.app')

@section('content')

<style>
  * { box-sizing: border-box; }

  body {
    background: #f5f7fa;
    margin: 0;
    padding: 0;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
  }

  .container-main {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 16px;
  }

  .card-container {
    background: #fff;
    border-radius: 20px;
    padding: 24px 20px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  }

  .header-back {
    display: flex;
    align-items: center;
    margin-bottom: 24px;
    gap: 12px;
  }

  .back-btn {
    background: none;
    border: none;
    font-size: 24px;
    cursor: pointer;
    color: #1a202c;
    padding: 0;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .back-btn:active {
    opacity: 0.7;
  }

  .header-title {
    font-size: 20px;
    font-weight: 600;
    color: #1a202c;
    margin: 0;
    flex: 1;
  }

  .logo-section {
    text-align: center;
    margin-bottom: 24px;
  }

  .logo {
    width: 48px;
    height: 48px;
    margin: 0 auto 8px;
  }

  .logo-text {
    font-size: 14px;
    color: #3b82f6;
    font-weight: 600;
    letter-spacing: 1px;
  }

  .user-info {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
  }

  .user-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #dbeafe;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 600;
    color: #3b82f6;
    flex-shrink: 0;
  }

  .user-details h3 {
    margin: 0 0 4px 0;
    font-size: 16px;
    color: #1a202c;
    font-weight: 600;
  }

  .user-details p {
    margin: 0;
    font-size: 13px;
    color: #64748b;
  }

  .section {
    margin-bottom: 24px;
  }

  .section-label {
    font-size: 13px;
    font-weight: 600;
    color: #3b82f6;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 8px;
  }

  .section-content {
    background: #f8fafc;
    border-radius: 12px;
    padding: 16px;
  }

  .section-value {
    font-size: 14px;
    color: #1a202c;
    font-weight: 500;
    word-break: break-word;
  }

  .file-section {
    background: #f8fafc;
    border-radius: 12px;
    padding: 32px 16px;
    text-align: center;
  }

  .file-icon {
    font-size: 48px;
    margin-bottom: 12px;
  }

  .file-btn {
    padding: 10px 24px;
    background: #3b82f6;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
  }

  .file-btn:active {
    background: #2563eb;
  }

  .textarea-section {
    position: relative;
  }

  .reason-textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
    resize: vertical;
    min-height: 100px;
    background: #f8fafc;
  }

  .reason-textarea:focus {
    outline: none;
    border-color: #3b82f6;
    background: #fff;
  }

  .char-count {
    font-size: 12px;
    color: #94a3b8;
    margin-top: 4px;
    text-align: right;
  }

  .actions-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-top: 24px;
  }

  .btn-action {
    padding: 12px 16px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-accept {
    background: #10b981;
    color: #fff;
  }

  .btn-accept:active {
    background: #059669;
    transform: scale(0.98);
  }

  .btn-reject {
    background: #ef4444;
    color: #fff;
  }

  .btn-reject:active {
    background: #dc2626;
    transform: scale(0.98);
  }

  .loading {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    gap: 12px;
  }

  .spinner {
    width: 40px;
    height: 40px;
    border: 4px solid #e2e8f0;
    border-top-color: #3b82f6;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
  }

  @keyframes spin {
    to { transform: rotate(360deg); }
  }

  .error-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    gap: 16px;
    text-align: center;
    padding: 20px;
  }

  .error-icon {
    font-size: 64px;
  }

  .error-text {
    font-size: 18px;
    color: #1a202c;
    font-weight: 600;
  }

  .error-description {
    font-size: 14px;
    color: #64748b;
    margin-top: 8px;
  }

  .btn-back-error {
    margin-top: 16px;
    padding: 12px 32px;
    background: #3b82f6;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
  }

  .btn-back-error:active {
    background: #2563eb;
  }

  @media (min-width: 768px) {
    .card-container {
      max-width: 480px;
      padding: 32px 28px;
    }

    .container-main {
      padding: 24px;
    }
  }
</style>

<div class="container-main">
  <div id="content"></div>
</div>

<script>
(async function(){
  const contentDiv = document.getElementById('content');
  const urlParams = new URLSearchParams(window.location.search);
  const recordId = urlParams.get('id');

  if (!recordId) {
    showError('ID no proporcionado', 'Por favor, selecciona un registro para validar');
    return;
  }

  showLoading();

  try {
    const res = await fetch('{{ route('admin.profile.professional.show', ['id' => ':id']) }}'.replace(':id', recordId), {
      credentials: 'same-origin'
    });

    if (!res.ok) throw new Error('No se pudo cargar el registro');

    const json = await res.json();
    const record = json.data || json;

    renderCard(record);
  } catch (e) {
    console.error(e);
    showError('Error', 'No se pudo cargar los datos del profesional');
  }

  function showLoading() {
    contentDiv.innerHTML = '<div class="loading"><div class="spinner"></div><p>Cargando...</p></div>';
  }

  function showError(title, description) {
    contentDiv.innerHTML = `
      <div class="error-container">
        <div class="error-icon">⚠️</div>
        <div class="error-text">${title}</div>
        <div class="error-description">${description}</div>
        <button class="btn-back-error" onclick="history.back()">Volver</button>
      </div>
    `;
  }

  function getInitials(name) {
    return (name || 'U').split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
  }

  function getStatusText(status) {
    const map = { aceptado: 'Aceptado', rechazado: 'Rechazado', pendiente: 'Pendiente' };
    return map[status] || status || 'Pendiente';
  }

  function renderCard(record) {
    const user = record.user || {};
    const userName = user.name || 'Usuario';
    const userEmail = user.email || '';
    const userRole = user.role || 'Profesional';
    const specialty = record.specialty || 'No especificada';
    const status = getStatusText(record.status);
    const filePath = record.path || '';

    contentDiv.innerHTML = `
      <div class="card-container">
        <div class="header-back">
          <button class="back-btn" onclick="history.back()">‹</button>
          <h2 class="header-title">Validación de cédulas</h2>
        </div>

        <div class="logo-section">
          <div class="logo">✓</div>
          <div class="logo-text">VITALIA</div>
        </div>

        <div class="user-info">
          <div class="user-avatar">${getInitials(userName)}</div>
          <div class="user-details">
            <h3>${userEmail}</h3>
            <p>${userRole}</p>
          </div>
        </div>

        <div class="section">
          <label class="section-label">Cédula adjuntada</label>
          <div class="file-section">
            <div class="file-icon">📄</div>
            ${filePath ? `
              <a href="/storage/${filePath}" target="_blank" class="file-btn">Ver Archivo</a>
            ` : `
              <div style="font-size: 14px; color: #94a3b8;">Sin archivo</div>
            `}
          </div>
        </div>

        <div class="section">
          <label class="section-label">Especialidad</label>
          <div class="section-content">
            <div class="section-value">${specialty}</div>
          </div>
        </div>

        <div class="section">
          <label class="section-label">Especifica la razón de la aprobación o de la desaprobación</label>
          <div class="textarea-section">
            <textarea class="reason-textarea" id="reasonInput" placeholder="Describe por qué apruebas o rechazas esta solicitud..." maxlength="500"></textarea>
            <div class="char-count"><span id="charCount">0</span>/500</div>
          </div>
        </div>

        <div class="actions-section">
          <button class="btn-action btn-accept" onclick="handleValidate(${record.id}, 'aceptado')">Validar</button>
          <button class="btn-action btn-reject" onclick="handleValidate(${record.id}, 'rechazado')">Rechazar</button>
        </div>
      </div>
    `;

    // Character counter
    const textarea = document.getElementById('reasonInput');
    const charCount = document.getElementById('charCount');
    textarea.addEventListener('input', (e) => {
      charCount.textContent = e.target.value.length;
    });
  }

  window.handleValidate = function(recordId, status) {
    const reason = document.getElementById('reasonInput').value;
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    if (!token) {
      console.error('Token CSRF no encontrado');
      return;
    }

    // Crear un form temporal para enviar
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route('admin.profile.professional.validate', ['id' => ':id']) }}'.replace(':id', recordId);

    const tokenInput = document.createElement('input');
    tokenInput.type = 'hidden';
    tokenInput.name = '_token';
    tokenInput.value = token;
    form.appendChild(tokenInput);

    const statusInput = document.createElement('input');
    statusInput.type = 'hidden';
    statusInput.name = 'status';
    statusInput.value = status;
    form.appendChild(statusInput);

    const reasonInput = document.createElement('input');
    reasonInput.type = 'hidden';
    reasonInput.name = 'reason';
    reasonInput.value = reason;
    form.appendChild(reasonInput);

    document.body.appendChild(form);
    form.submit();
  };
})();
</script>

@endsection
