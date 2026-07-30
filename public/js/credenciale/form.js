document.addEventListener('DOMContentLoaded', function () {
    // ═══════════════════════════════════════════════════════════════════
    // MAYÚSCULAS EN TODOS LOS CAMPOS DE TEXTO
    // ═══════════════════════════════════════════════════════════════════

    document.querySelectorAll('input[type="text"], textarea').forEach(function (el) {
        el.addEventListener('input', function () {
            this.value = this.value.toUpperCase();
        });
    });

    // ═══════════════════════════════════════════════════════════════════
    // VALIDACION CURP
    // ═══════════════════════════════════════════════════════════════════

    const regexCURP = /^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z0-9]\d$/i;
    const curpInput = document.getElementById('curp');

    if (curpInput) {
        curpInput.addEventListener('input', function () {
            this.value = this.value.toUpperCase();
            if (this.value.length === 0) {
                this.style.border = '';
            } else if (regexCURP.test(this.value)) {
                this.style.border = '2px solid #28a745';
            } else {
                this.style.border = '2px solid #dc3545';
            }
        });
    }

    // ═══════════════════════════════════════════════════════════════════
    // FIRMA (CANVAS)
    // ═══════════════════════════════════════════════════════════════════

    const canvas = document.getElementById('firma-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const hiddenInput = document.getElementById('firma');
    const btnLimpiar = document.getElementById('btn-limpiar-firma');
    let dibujando = false;
    let hasDrawn = false;
    let lastX = 0;
    let lastY = 0;

    // Estilo de la linea
    ctx.strokeStyle = '#000';
    ctx.lineWidth = 2;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';

    // Cargar firma existente (edicion)
    if (typeof firmaExistente !== 'undefined' && firmaExistente) {
        hasDrawn = true;
        const img = new Image();
        img.onload = function () {
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        };
        img.src = firmaExistente;
    }

    // Obtener coordenadas relativas al canvas
    function getPos(e) {
        const rect = canvas.getBoundingClientRect();
        if (e.touches) {
            return {
                x: e.touches[0].clientX - rect.left,
                y: e.touches[0].clientY - rect.top,
            };
        }
        return {
            x: e.clientX - rect.left,
            y: e.clientY - rect.top,
        };
    }

    // Detectar si el evento es touch
    function isTouch(e) {
        return e.type.startsWith('touch');
    }

    // Prevenir scroll en mobile al tocar el canvas
    canvas.addEventListener('touchstart', function (e) {
        e.preventDefault();
        dibujando = true;
        hasDrawn = true;
        const pos = getPos(e);
        lastX = pos.x;
        lastY = pos.y;
    }, { passive: false });

    canvas.addEventListener('touchmove', function (e) {
        e.preventDefault();
        if (!dibujando) return;
        const pos = getPos(e);
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
        lastX = pos.x;
        lastY = pos.y;
    }, { passive: false });

    canvas.addEventListener('touchend', function () {
        dibujando = false;
        guardarFirma();
    });

    // Eventos de mouse
    canvas.addEventListener('mousedown', function (e) {
        dibujando = true;
        hasDrawn = true;
        const pos = getPos(e);
        lastX = pos.x;
        lastY = pos.y;
    });

    canvas.addEventListener('mousemove', function (e) {
        if (!dibujando) return;
        const pos = getPos(e);
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(pos.x, pos.y);
        ctx.stroke();
        lastX = pos.x;
        lastY = pos.y;
    });

    canvas.addEventListener('mouseup', function () {
        dibujando = false;
        guardarFirma();
    });

    canvas.addEventListener('mouseleave', function () {
        dibujando = false;
    });

    // Guardar firma en hidden input
    function guardarFirma() {
        hiddenInput.value = canvas.toDataURL('image/png');
    }

    // Limpiar canvas
    btnLimpiar.addEventListener('click', function () {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        hiddenInput.value = '';
        hasDrawn = false;
    });

    // Enviar firma solo si se dibujo algo
    var form = canvas.closest('form');
    if (form) {
        form.addEventListener('submit', function () {
            if (!hasDrawn) {
                hiddenInput.value = '';
            }
        });
    }

    // ═══════════════════════════════════════════════════════════════════
    // CAMARA PARA FOTO (2.5 x 3 cm = 295 x 354 px a 300dpi)
    // ═══════════════════════════════════════════════════════════════════

    let camaraStream = null;
    let camaraActual = 'user';

    const camModal = document.getElementById('camera-modal');
    const camVideo = document.getElementById('camera-video');
    const camCanvas = document.getElementById('camera-canvas');
    const camCapture = document.getElementById('capture-btn');
    const camSwitch = document.getElementById('switch-camera-btn');
    const camClose = document.getElementById('close-camera-btn');
    const fotoHidden = document.getElementById('foto');
    const fotoPreview = document.getElementById('preview-foto');
    const fotoFile = document.getElementById('file-foto');

    function mostrarPreviewFoto(base64) {
        fotoPreview.innerHTML =
            '<div style="position:relative;display:inline-block;">' +
                '<img src="' + base64 + '" style="height:120px; border-radius:8px; border:1px solid #ccc; object-fit:cover;">' +
                '<button type="button" onclick="limpiarFoto()" ' +
                    'style="position:absolute;top:3px;right:3px;width:20px;height:20px;border-radius:50%;' +
                    'background:rgba(0,0,0,.5);color:#fff;border:none;cursor:pointer;font-size:14px;' +
                    'line-height:1;padding:0;">&times;</button>' +
            '</div>';
    }

    window.limpiarFoto = function () {
        fotoHidden.value = '';
        fotoPreview.innerHTML = '';
        if (fotoFile) fotoFile.value = '';
    };

    async function abrirCamaraFoto() {
        if (camaraStream) camaraStream.getTracks().forEach(function (t) { t.stop(); });

        var constraints = { video: { facingMode: camaraActual } };
        if (window.ultimoDeviceIdFoto) {
            constraints.video = { deviceId: { exact: window.ultimoDeviceIdFoto } };
        }

        try {
            camaraStream = await navigator.mediaDevices.getUserMedia(constraints);
            camVideo.srcObject = camaraStream;
            camModal.style.display = 'flex';
        } catch (err) {
            constraints.video = { facingMode: camaraActual };
            try {
                camaraStream = await navigator.mediaDevices.getUserMedia(constraints);
                camVideo.srcObject = camaraStream;
                camModal.style.display = 'flex';
            } catch (e) {
                alert('Error: No se pudo acceder a la cámara.');
            }
        }
    }
    window.abrirCamaraFoto = abrirCamaraFoto;

    camCapture.addEventListener('click', function () {
        camCanvas.width = 295;
        camCanvas.height = 354;
        var camCtx = camCanvas.getContext('2d');

        // Recortar centrado (aspect ratio 2.5:3 = 0.833)
        var videoW = camVideo.videoWidth;
        var videoH = camVideo.videoHeight;
        var targetRatio = 295 / 354;
        var videoRatio = videoW / videoH;
        var sx, sy, sw, sh;

        if (videoRatio > targetRatio) {
            sh = videoH;
            sw = videoH * targetRatio;
            sx = (videoW - sw) / 2;
            sy = 0;
        } else {
            sw = videoW;
            sh = videoW / targetRatio;
            sx = 0;
            sy = (videoH - sh) / 2;
        }

        camCtx.drawImage(camVideo, sx, sy, sw, sh, 0, 0, 295, 354);

        var base64 = camCanvas.toDataURL('image/jpeg', 0.9);
        fotoHidden.value = base64;
        mostrarPreviewFoto(base64);
        cerrarCamaraFoto();
    });

    camSwitch.addEventListener('click', async function () {
        var devices = await navigator.mediaDevices.enumerateDevices();
        var videoDevices = devices.filter(function (d) { return d.kind === 'videoinput'; });
        if (videoDevices.length < 2) return;

        if (camaraStream) camaraStream.getTracks().forEach(function (t) { t.stop(); });

        var currentTrack = camVideo.srcObject ? camVideo.srcObject.getVideoTracks()[0] : null;
        var currentId = currentTrack ? currentTrack.getSettings().deviceId : null;
        var nextIndex = 0;

        if (currentId) {
            var currentIndex = videoDevices.findIndex(function (d) { return d.deviceId === currentId; });
            nextIndex = (currentIndex + 1) % videoDevices.length;
        }

        var nextDevice = videoDevices[nextIndex];

        try {
            camaraStream = await navigator.mediaDevices.getUserMedia({
                video: { deviceId: { exact: nextDevice.deviceId } }
            });
            camVideo.srcObject = camaraStream;

            var label = nextDevice.label.toLowerCase();
            if (label.includes('back') || label.includes('trasera') || label.includes('environment')) {
                camaraActual = 'environment';
            } else if (label.includes('front') || label.includes('frontal') || label.includes('user')) {
                camaraActual = 'user';
            } else {
                window.ultimoDeviceIdFoto = nextDevice.deviceId;
            }
        } catch (e) {
            console.error('Error al cambiar cámara', e);
        }
    });

    function cerrarCamaraFoto() {
        if (camaraStream) camaraStream.getTracks().forEach(function (t) { t.stop(); });
        camaraStream = null;
        camModal.style.display = 'none';
    }

    camClose.addEventListener('click', cerrarCamaraFoto);

    // Preview de archivo seleccionado por input
    if (fotoFile) {
        fotoFile.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    fotoHidden.value = e.target.result;
                    mostrarPreviewFoto(e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Cargar foto existente (edicion)
    if (typeof fotoExistente !== 'undefined' && fotoExistente) {
        mostrarPreviewFoto(fotoExistente);
    }
});
