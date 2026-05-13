<?php $__env->startSection('content'); ?>

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
    align-items: flex-start;
    padding: 12px 8px;
    padding-top: 16px;
    padding-bottom: 120px;
  }

  .card-container {
    background: #fff;
    border-radius: 16px;
    padding: 16px;
    width: 100%;
    max-width: 100%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  }

  .header-back {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
    gap: 8px;
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
    flex-shrink: 0;
  }

  .back-btn:active {
    opacity: 0.7;
  }

  .header-title {
    font-size: 16px;
    font-weight: 600;
    color: #1a202c;
    margin: 0;
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }

  .logo-section {
    text-align: center;
    margin-bottom: 16px;
  }

  .logo {
    width: 40px;
    height: 40px;
    margin: 0 auto 6px;
    font-size: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .logo-text {
    font-size: 12px;
    color: #3b82f6;
    font-weight: 600;
    letter-spacing: 1px;
  }

  .user-info {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
  }

  .user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #dbeafe;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    font-weight: 600;
    color: #3b82f6;
    flex-shrink: 0;
  }

  .user-details h3 {
    margin: 0 0 2px 0;
    font-size: 14px;
    color: #1a202c;
    font-weight: 600;
    word-break: break-word;
    overflow-wrap: break-word;
  }

  .user-details p {
    margin: 0;
    font-size: 12px;
    color: #64748b;
    word-break: break-word;
    overflow-wrap: break-word;
  }

  .section {
    margin-bottom: 16px;
  }

  .section-label {
    font-size: 11px;
    font-weight: 600;
    color: #3b82f6;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
  }

  .section-content {
    background: #f8fafc;
    border-radius: 10px;
    padding: 12px;
  }

  .section-value {
    font-size: 13px;
    color: #1a202c;
    font-weight: 500;
    word-break: break-word;
    overflow-wrap: break-word;
  }

  .file-section {
    background: #f8fafc;
    border-radius: 10px;
    padding: 20px 12px;
    text-align: center;
  }

  .file-icon {
    font-size: 40px;
    margin-bottom: 10px;
  }

  .file-btn {
    padding: 9px 20px;
    background: #3b82f6;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
  }

  .file-btn:active {
    background: #2563eb;
    transform: scale(0.98);
  }

  .textarea-section {
    position: relative;
    margin-bottom: 16px;
  }

  .reason-textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    font-family: inherit;
    resize: vertical;
    min-height: 80px;
    background: #f8fafc;
  }

  .reason-textarea:focus {
    outline: none;
    border-color: #3b82f6;
    background: #fff;
  }

  .char-count {
    font-size: 11px;
    color: #94a3b8;
    margin-top: 3px;
    text-align: right;
  }

  .actions-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-top: 16px;
  }

  .btn-action {
    padding: 11px 12px;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    min-height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
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
    min-height: 60vh;
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
    min-height: 60vh;
    gap: 12px;
    text-align: center;
    padding: 20px;
  }

  .error-icon {
    font-size: 48px;
  }

  .error-text {
    font-size: 16px;
    color: #1a202c;
    font-weight: 600;
  }

  .error-description {
    font-size: 13px;
    color: #64748b;
    margin-top: 6px;
  }

  .btn-back-error {
    margin-top: 12px;
    padding: 11px 20px;
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

  @media (min-width: 480px) {
    .container-main {
      padding: 16px;
      align-items: center;
      padding-bottom: 40px;
    }

    .card-container {
      max-width: 420px;
      padding: 20px;
      border-radius: 20px;
    }

    .header-title {
      font-size: 18px;
    }

    .logo {
      width: 48px;
      height: 48px;
      font-size: 36px;
    }

    .logo-text {
      font-size: 14px;
    }

    .user-avatar {
      width: 60px;
      height: 60px;
      font-size: 24px;
    }

    .user-details h3 {
      font-size: 16px;
    }

    .file-section {
      padding: 28px 16px;
    }

    .file-icon {
      font-size: 48px;
    }

    .btn-action {
      padding: 12px 16px;
      font-size: 16px;
    }
  }

  @media (min-width: 768px) {
    .container-main {
      padding: 24px;
    }

    .card-container {
      max-width: 480px;
      padding: 32px 28px;
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
    const res = await fetch('<?php echo e(route('admin.profile.professional.show', ['id' => ':id'])); ?>'.replace(':id', recordId), {
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
    form.action = '<?php echo e(route('admin.profile.professional.validate', ['id' => ':id'])); ?>'.replace(':id', recordId);

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

<?php if (isset($component)) { $__componentOriginal36aa088aadd7276f1a1850953ba55642 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal36aa088aadd7276f1a1850953ba55642 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.vitalia-bottom-nav','data' => ['active' => 'home']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('vitalia-bottom-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active' => 'home']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal36aa088aadd7276f1a1850953ba55642)): ?>
<?php $attributes = $__attributesOriginal36aa088aadd7276f1a1850953ba55642; ?>
<?php unset($__attributesOriginal36aa088aadd7276f1a1850953ba55642); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal36aa088aadd7276f1a1850953ba55642)): ?>
<?php $component = $__componentOriginal36aa088aadd7276f1a1850953ba55642; ?>
<?php unset($__componentOriginal36aa088aadd7276f1a1850953ba55642); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pablo\vitalia-api\resources\views/livewire/admin/view-professional-data.blade.php ENDPATH**/ ?>