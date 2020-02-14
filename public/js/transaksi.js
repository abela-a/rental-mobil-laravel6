$(document).ready(function() {
    // SOPIRCHECK
    $("#sopir-check").change(function() {
        if (this.checked) {
            $("#show-sopir")
                .removeClass("d-none")
                .addClass("d-inline");
        } else {
            $("#show-sopir")
                .removeClass("d-inline")
                .addClass("d-none");
            $("#sopir_id").val("SPR000");
            $("#tarif-perhari").val(0);
        }
    });

    // MOBIL
    $("#mobil-id").change(function() {
        var harga = $("option:selected", this).attr("harga");
        $("#harga-sewa").val(harga);
        total();
    });

    // SOPIR
    $("#sopir-id").change(function() {
        var harga = $("option:selected", this).attr("harga");
        $("#tarif-perhari").val(harga);
        total();
    });

    // RANGE DATE
    $("#tanggal-kembali-rencana").change(function() {
        console.log($(this).val());

        var tanggalMulai = $("input[name='tanggal_pinjam']").val();
        var tanggalAkhir = $("input[name='tanggal_kembali_rencana']").val();

        var tanggalMulai = moment(tanggalMulai);
        var tanggalAkhir = moment(tanggalAkhir);

        var lamaRental = tanggalAkhir.diff(tanggalMulai, "days");

        $("#lama-rental").val(lamaRental);

        total();
    });

    function total() {
        var hargaSewaMobil = $("#harga-sewa").val();
        var lamaRental = $("#lama-rental").val();
        var tarifsopir_id = $("#tarif-perhari").val();

        var bayarMobil = hargaSewaMobil * lamaRental;
        var bayarsopir_id = tarifsopir_id * lamaRental;

        var totalBayar = bayarMobil + bayarsopir_id;

        if (!isNaN(totalBayar)) {
            $("#total-bayar").val(totalBayar);
        }
    }

    // ================================ //

    $("input[name='tanggal_kembali_sebenarnya']").change(function() {
        // DEKLARASI VARIABEL
        window.BiayaBBM = 0;
        window.BiayaKerusakan = 0;
        window.JumlahBayar = 0;

        var tanggalRencana = $("input[name='tanggal_kembali_rencana']").val();
        var tanggalSebenarnya = $(
            "input[name='tanggal_kembali_sebenarnya']"
        ).val();
        var tanggalRencana = moment(tanggalRencana);
        var tanggalSebenarnya = moment(tanggalSebenarnya);
        var JatuhTempo = tanggalSebenarnya.diff(tanggalRencana, "days");
        $("#lama_denda").val(JatuhTempo);

        var Denda = JatuhTempo * 50000;

        $("#denda")
            .val(Denda)
            .mask("0.000.000.000", { reverse: true });

        var totalSementara = parseFloat(
            $("#total_bayar")
                .val()
                .replace(/\D/g, "")
        );

        var hasilDenda = Denda + totalSementara;
        $("#total_bayar")
            .val(hasilDenda)
            .mask("0.000.000.000", { reverse: true });

        $("#biaya_bbm").keyup(function() {
            window.BiayaBBM = parseFloat(
                $(this)
                    .val()
                    .replace(/\D/g, "")
            );
            TotalAkhir();
            TotalAkhirPelanggan();
        });

        $("#biaya_kerusakan").keyup(function() {
            window.BiayaKerusakan = parseFloat(
                $(this)
                    .val()
                    .replace(/\D/g, "")
            );
            TotalAkhir();
            TotalAkhirPelanggan();
        });

        $("#jumlah_bayar").keyup(function() {
            TotalAkhir();
            JumlahBayar = parseFloat(
                $(this)
                    .val()
                    .replace(/\D/g, "")
            );
            TotalAkhirPelanggan();
        });

        function TotalAkhirPelanggan() {
            totalAkhirBayar = parseFloat($("#total_bayar").val());
            totalPelanggan = JumlahBayar - totalAkhirBayar;
            if (!isNaN(totalPelanggan)) {
                $("#kembalian")
                    .val(totalPelanggan)
                    .mask("0.000.000.000", { reverse: true });
            }
        }

        function TotalAkhir() {
            totalAkhirBayar = parseFloat(
                totalSementara + Denda + BiayaKerusakan + BiayaBBM
            );
            $("#total_bayar").val(totalAkhirBayar);
        }
    });
});
