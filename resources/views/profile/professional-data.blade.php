@extends('layouts.app')

@section('content')
<div class="mb-6" style="padding: 0 8px;">
    <div class="flex flex-col items-center">
        <x-vitalia-logo class="scale-[0.58] sm:scale-[0.66]" />
    </div>

    <div class="flex items-center gap-2 px-2" style="min-height: 40px;">
        <a href="{{ route('profile.dashboard') }}" class="text-slate-900 flex-shrink-0">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6">
                <path d="M15 18L9 12L15 6" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </a>
        <h1 class="text-[18px] sm:text-[22px] font-bold text-slate-900 truncate">Validar de Cédulas</h1>
    </div>

<style>
  * { box-sizing: border-box; }
  
  body {
    background: #f3f4f6;
    padding: 0;
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
  }

  .prof-container {
    max-width: 100%;
    width: 100%;
    margin: 12px auto;
    padding: 16px;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    font-family: Arial, Helvetica, sans-serif;
    padding-bottom: 100px;
  }

  .prof-header {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 16px;
  }

  .prof-header img {
    height: 38px;
    flex-shrink: 0;
  }

  .title {
    font-size: 18px;
    font-weight: 700;
    line-height: 1.3;
  }

  .muted {
    color: #6b7280;
    font-size: 13px;
    line-height: 1.4;
    margin: 0;
  }

  .drop-area {
    border: 1px dashed #e5e7eb;
    border-radius: 8px;
    padding: 18px;
    text-align: center;
    background: #f8fafc;
    color: #6b7280;
    margin-top: 10px;
    cursor: pointer;
    transition: all 0.2s;
    word-break: break-word;
    overflow-wrap: break-word;
  }

  .drop-area:focus {
    outline: 2px solid #0b5ed7;
    outline-offset: 2px;
  }

  .drop-area.dragover {
    border-color: #2563eb;
    background: #eef6ff;
  }

  .file-name {
    margin-top: 8px;
    color: #111827;
    font-size: 13px;
    word-break: break-word;
    overflow-wrap: break-word;
  }

  .help-text {
    font-size: 13px;
    color: #ef4444;
    margin-top: 6px;
  }

  .input-inline {
    margin-top: 16px;
  }

  .input-inline label {
    display: block;
    margin-bottom: 6px;
  }

  .text-input {
    width: 100%;
    padding: 10px 12px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    font-size: 16px;
    font-family: inherit;
  }

  .text-input:focus {
    outline: none;
    border-color: #0b5ed7;
    background: #fff;
  }

  .btn-primary {
    display: block;
    width: 100%;
    background: #0b5ed7;
    color: #fff;
    padding: 12px 16px;
    border-radius: 10px;
    border: none;
    margin-top: 20px;
    font-weight: 700;
    font-size: 16px;
    box-shadow: 0 4px 10px rgba(11,94,215,0.12);
    cursor: pointer;
    transition: all 0.2s;
  }

  .btn-primary:active {
    background: #0a47b8;
    transform: scale(0.98);
  }

  .btn-primary[disabled] {
    background: #94a3b8;
    color: #fff;
    cursor: not-allowed;
    box-shadow: none;
    opacity: 0.7;
  }

  .text-input[disabled],
  .text-input[readonly] {
    background: #f1f5f9;
    color: #475569;
    cursor: not-allowed;
  }

  .drop-area.disabled {
    background: #fbfdff;
    border-color: #cbd5e1;
    color: #64748b;
    cursor: not-allowed;
    opacity: 0.6;
  }

  .status-pill {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 999px;
    font-weight: 600;
    color: #fff;
    font-size: 12px;
  }

  .status-pendiente {
    background: #f59e0b;
  }

  .status-aceptado {
    background: #10b981;
  }

  .status-rechazado {
    background: #ef4444;
  }

  .status-row {
    margin-top: 16px;
  }

  #statusReason {
    word-break: break-word;
    overflow-wrap: break-word;
  }

  #viewDocumentLink {
    color: #0b5ed7;
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
    margin-top: 8px;
  }

  #viewDocumentLink:active {
    opacity: 0.8;
  }

  @media (min-width: 480px) {
    .prof-container {
      max-width: 420px;
      margin: 24px auto;
      padding: 24px;
    }

    .prof-header {
      margin-bottom: 20px;
    }

    .title {
      font-size: 20px;
    }

    .drop-area {
      padding: 24px;
      margin-top: 12px;
    }

    .input-inline {
      margin-top: 18px;
    }

    .btn-primary {
      margin-top: 24px;
      padding: 14px 20px;
      font-size: 16px;
    }
  }

  @media (min-width: 768px) {
    .prof-container {
      max-width: 480px;
      padding: 32px;
      padding-bottom: 40px;
    }

    .prof-header {
      margin-bottom: 24px;
    }

    .drop-area {
      padding: 28px;
    }
  }
</style>

<div class="prof-container">
  <div class="prof-header">
    <img src="/images/logo.png" alt="logo" onerror="this.style.display='none'"/>
    <div>
      <div class="title">Perfil Profesional</div>
      <div class="muted">Sube tu información que te avala como profesional de la salud.</div>
    </div>
  </div>

  <form id="professionalForm" action="{{ route('profile.professional.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label class="muted">Adjuntar cédula *</label>

    <div id="dropArea" class="drop-area" tabindex="0">
      <div id="dropIcon">📁</div>
      <div id="dropText">Sube tu archivo, formatos permitidos: PDF, XML. Máx 2MB</div>
      <div id="fileName" class="file-name" style="display:none"></div>
    </div>

    <input id="fileInput" name="document" type="file" accept=".pdf,.xml,application/pdf,text/xml,application/xml" style="display:none" />
    <div id="fileHelp" class="help-text" style="display:none"></div>

    <div class="input-inline">
      <label class="muted">Especifica tu especialidad *</label>
      <input name="specialty" class="text-input" placeholder="Especifica tu especialidad" />
    </div>

    <div id="statusRow" class="status-row" style="display:none">
      <span id="statusPill" class="status-pill"></span>
      <div id="statusReason" class="muted" style="margin-top:8px"></div>
    </div>

      <div id="infoLegend" class="muted" style="margin-top:8px;display:none">Ya cuentas con una solicitud</div>
      <a id="viewDocumentLink" href="#" target="_blank" style="color: #0b5ed7;display:none;margin-top:8px;display:inline-block">Ver documento</a>

    <button id="submitBtn" type="submit" class="btn-primary">Enviar Solicitud</button>
  </form>

</div>

<script>
(() => {
  const dropArea = document.getElementById('dropArea');
  const fileInput = document.getElementById('fileInput');
  const fileNameEl = document.getElementById('fileName');
  const fileHelp = document.getElementById('fileHelp');
  const statusRow = document.getElementById('statusRow');
  const statusPill = document.getElementById('statusPill');
  const statusReason = document.getElementById('statusReason');

  const MAX_BYTES = 2 * 1024 * 1024; // 2MB
  const allowedMimes = ['application/pdf','text/xml','application/xml'];
  const statusUrl = '{{ route('profile.professional.status') }}';
  const viewDocumentLink = document.getElementById('viewDocumentLink');
  const infoLegend = document.getElementById('infoLegend');
  const specialtyInput = document.querySelector('input[name="specialty"]');
  let isLocked = false;

  function resetError(){ fileHelp.style.display='none'; fileHelp.textContent=''; }
  function showError(msg){ fileHelp.style.display='block'; fileHelp.textContent=msg; }

  function setLocked(locked){
    isLocked = !!locked;
    if(locked){
      dropArea.classList.add('disabled');
      dropArea.style.opacity = '0.6';
      dropArea.style.pointerEvents = 'none';
      fileInput.disabled = true;
      specialtyInput.readOnly = true;
      specialtyInput.disabled = true;
      const btn = document.getElementById('submitBtn');
      btn.disabled = true;
      btn.textContent = 'Solicitud enviada';
    } else {
      dropArea.classList.remove('disabled');
      dropArea.style.opacity = '1';
      dropArea.style.pointerEvents = '';
      fileInput.disabled = false;
      specialtyInput.readOnly = false;
      specialtyInput.disabled = false;
      const btn = document.getElementById('submitBtn');
      btn.disabled = false;
      btn.textContent = 'Enviar Solicitud';
    }
  }

  async function fetchStatus(){
    try{
      const res = await fetch(statusUrl, { credentials: 'same-origin' });
      if(!res.ok) return;
      const json = await res.json();
      const record = json.data;
      if(!record) return;

      // show status
      statusRow.style.display = 'block';
      const status = (record.status || '').toLowerCase();
      statusPill.className = 'status-pill';
      if(status === 'pendiente'){ statusPill.classList.add('status-pendiente'); statusPill.textContent='Pendiente'; }
      else if(status === 'aceptado'){ statusPill.classList.add('status-aceptado'); statusPill.textContent='Aceptado'; }
      else if(status === 'rechazado'){ statusPill.classList.add('status-rechazado'); statusPill.textContent='Rechazado'; }
      else { statusPill.textContent = record.status || 'Desconocido'; }

      if((status === 'rechazado' || status === 'aceptado') && record.reason){ statusReason.textContent = 'Motivo: ' + record.reason; }
      else { statusReason.textContent = '' }

      // link to view document
      if(record.path){
        const url = '/storage/' + record.path;
        viewDocumentLink.href = url;
        viewDocumentLink.style.display = 'inline-block';
        // show filename in drop area
        try{
          const parts = record.path.split('/');
          const filename = parts.length ? parts[parts.length-1] : record.path;
          fileNameEl.style.display = 'block';
          fileNameEl.textContent = filename;
        }catch(e){}
      }

      // fill specialty input with saved value
      if(record.specialty){
        specialtyInput.value = record.specialty;
      }

      // If pending, lock UI and show legend. If accepted, lock UI but hide legend. If rejected, allow re-submit
      if(status === 'pendiente'){
        infoLegend.style.display = 'block';
        setLocked(true);
      } else if(status === 'aceptado'){
        infoLegend.style.display = 'none';
        setLocked(true);
      } else if(status === 'rechazado'){
        infoLegend.style.display = 'none';
        setLocked(false);
      }
    }catch(e){/* ignore */}
  }

  dropArea.addEventListener('click', ()=> { if(!isLocked) fileInput.click(); });
  dropArea.addEventListener('keydown', (e)=>{ if(e.key === 'Enter' || e.key === ' ') { e.preventDefault(); fileInput.click(); } });

  dropArea.addEventListener('dragover', (e)=>{ e.preventDefault(); dropArea.classList.add('dragover'); });
  dropArea.addEventListener('dragleave', ()=>{ dropArea.classList.remove('dragover'); });
  dropArea.addEventListener('drop', (e)=>{ e.preventDefault(); dropArea.classList.remove('dragover'); const f = e.dataTransfer.files[0]; if(f) handleFile(f); });

  fileInput.addEventListener('change', (e)=>{ const f = e.target.files[0]; if(f) handleFile(f); });

  function handleFile(file){
    resetError();
    // size
    if(file.size > MAX_BYTES){ showError('Archivo demasiado pesado, máximo 2MB'); fileInput.value=''; fileNameEl.style.display='none'; return; }
    // mime or extension
    const mimeOk = allowedMimes.includes(file.type);
    const ext = (file.name.split('.').pop() || '').toLowerCase();
    const extOk = ['pdf','xml'].includes(ext);
    if(!mimeOk && !extOk){ showError('Formato no admitido, únicamente PDF y XML'); fileInput.value=''; fileNameEl.style.display='none'; return; }

    fileNameEl.style.display='block';
    fileNameEl.textContent = file.name + ' — ' + Math.round(file.size/1024) + ' KB';
  }

  document.getElementById('professionalForm').addEventListener('submit', async function(e){
    e.preventDefault(); resetError();
    const f = fileInput.files[0];
    if(!f){ showError('Por favor adjunta tu cédula en PDF o XML'); return; }
    const specialty = this.elements['specialty'].value.trim();
    if(!specialty){ showError('La especialidad es obligatoria'); return; }

    // Re-validate quickly
    if(f.size > MAX_BYTES){ showError('Archivo demasiado pesado, máximo 2MB'); return; }
    const ext = (f.name.split('.').pop() || '').toLowerCase();
    if(!['pdf','xml'].includes(ext)){ showError('Formato no admitido, únicamente PDF y XML'); return; }

    // Submit via fetch
    const btn = document.getElementById('submitBtn');
    btn.disabled = true; btn.textContent = 'Enviando...';
    const fd = new FormData();
    fd.append('document', f);
    fd.append('specialty', specialty);
    fd.append('_token', document.querySelector('input[name="_token"]').value);

    try{
      const res = await fetch(this.action, { method: 'POST', body: fd, credentials: 'same-origin' });
      const data = await res.json();
      if(!res.ok){
        // show validation errors if provided
        if(data && data.errors){
          const first = Object.values(data.errors)[0];
          showError(Array.isArray(first) ? first[0] : first);
        } else if(data && data.message){
          showError(data.message);
        } else {
          showError('Error en la solicitud');
        }
        return;
      }

      // on success, lock UI and show legend + link
      statusRow.style.display = 'block';
      statusPill.className = 'status-pill status-pendiente';
      statusPill.textContent = 'Pendiente';
      infoLegend.style.display = 'block';
      if(data.data && data.data.path){
        viewDocumentLink.href = '/storage/' + data.data.path;
        viewDocumentLink.style.display = 'inline-block';
      }
      if(data.data && data.data.specialty){
        specialtyInput.value = data.data.specialty;
      }
      setLocked(true);

    }catch(err){ showError('Error al enviar. Intenta nuevamente.'); }
    finally{ if(!isLocked){ btn.disabled=false; } btn.textContent='Enviar Solicitud'; }
  });

  // fetch existing status on load
  fetchStatus();

})();
</script>

<x-vitalia-bottom-nav active="home" />

@endsection
