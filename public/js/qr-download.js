// QR Code Download Helper - Simple QR + Logo PNG download
document.addEventListener("alpine:init", function () {
    Alpine.data("qrDownloader", function () {
        return {
            async downloadPng(filename) {
                var svgEl = this.$root.querySelector(".qr-code-wrapper svg");
                var logoEl = this.$root.querySelector(".center-logo");
                if (!svgEl) {
                    alert("QR code tidak ditemukan.");
                    return;
                }

                var size = 800; // Output image size in pixels
                var padding = 40;
                var canvasSize = size + padding * 2;

                // 1. Draw QR code SVG to canvas
                var svgClone = svgEl.cloneNode(true);
                svgClone.setAttribute("width", String(size));
                svgClone.setAttribute("height", String(size));
                var svgData = new XMLSerializer().serializeToString(svgClone);
                var svgBlob = new Blob([svgData], { type: "image/svg+xml;charset=utf-8" });
                var svgUrl = URL.createObjectURL(svgBlob);

                var qrImg = new Image();
                var qrLoaded = new Promise(function (resolve) {
                    qrImg.onload = resolve;
                    qrImg.onerror = resolve;
                    qrImg.src = svgUrl;
                });
                await qrLoaded;

                var canvas = document.createElement("canvas");
                canvas.width = canvasSize;
                canvas.height = canvasSize;
                var ctx = canvas.getContext("2d");

                // White background
                ctx.fillStyle = "#ffffff";
                ctx.fillRect(0, 0, canvasSize, canvasSize);

                // Draw QR
                ctx.drawImage(qrImg, padding, padding, size, size);
                URL.revokeObjectURL(svgUrl);

                // 2. Draw logo in center
                if (logoEl && logoEl.src) {
                    var logo = new Image();
                    logo.crossOrigin = "anonymous";
                    var logoLoaded = new Promise(function (resolve) {
                        logo.onload = resolve;
                        logo.onerror = resolve;
                        logo.src = logoEl.src;
                    });
                    await logoLoaded;

                    var logoSize = size * 0.2;
                    var cx = canvasSize / 2;
                    var cy = canvasSize / 2;

                    // White circle background behind logo
                    ctx.beginPath();
                    ctx.arc(cx, cy, logoSize / 2 + 8, 0, Math.PI * 2);
                    ctx.fillStyle = "#ffffff";
                    ctx.fill();

                    // Clip to circular shape
                    ctx.save();
                    ctx.beginPath();
                    ctx.arc(cx, cy, logoSize / 2, 0, Math.PI * 2);
                    ctx.clip();
                    
                    // Maintain proportional aspect ratio (object-fit: cover)
                    var sWidth = logo.naturalWidth || logo.width;
                    var sHeight = logo.naturalHeight || logo.height;
                    var sSize = Math.min(sWidth, sHeight);
                    var sx = (sWidth - sSize) / 2;
                    var sy = (sHeight - sSize) / 2;

                    ctx.drawImage(
                        logo,
                        sx, sy, sSize, sSize, // Source crop
                        cx - logoSize / 2, cy - logoSize / 2, logoSize, logoSize // Dest drawing
                    );
                    
                    ctx.restore();

                    // Logo border ring
                    ctx.beginPath();
                    ctx.arc(cx, cy, logoSize / 2 + 2, 0, Math.PI * 2);
                    ctx.strokeStyle = "#ffffff";
                    ctx.lineWidth = 4;
                    ctx.stroke();
                }

                // 3. Download
                var link = document.createElement("a");
                link.download = filename;
                link.href = canvas.toDataURL("image/png");
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
        };
    });
});
