<!DOCTYPE html>
<html>

<head>
    <title>AKUN SISTEM SKBHK</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        b {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: black;
            font-size: 15px;
            font-weight: 2000;
        }

        td {
            vertical-align: text-top;
        }
        p,
        td {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 13px;
            color: rgb(0, 0, 0)
        }

        u {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: rgb(0, 0, 0);
        }

        hr {
            border-top: 1px solid rgb(0, 0, 0);

        }

        .title {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: black;
            font-size: 18px;
            font-weight: 800;
        }

        .logo {
            width: 100px;
            /* Adjust the width as needed */
        }
    </style>
</head>

<body>
    <div align= "center">
        <a>
            <img class="logo" src="assets/img/logos/logo-alfa.png">
        </a>
    </div>
    <div align="center">
        <b class="title">{{ $surat->karyawan->masterBranchFranchises->nama_pt ?? '' }}</b>
        <p>
            Alamat: {{ $surat->karyawan->masterBranchFranchises->alamat ?? '' }}
        </p>
        <hr>
    </div>
    <div align="center">
        <b>
            <u class="title">
                SURAT KEPUTUSAN
            </u>
        </b>
        <p>
            No: {{ $surat->no_surat }}
        </p>
    </div>
    <div align="center">
        <b>
            Tentang <br> Berakhirnya Hubungan Kerja
        </b>
    </div>
    <table align="left" width=85% style="margin:15px">
        <tr>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td colspan="1" style="padding-right: 40px;">Menimbang</td>
            <td colspan="3" vertical-align= "top;" style="padding-right: 20px;">:</td>
            <td style="padding-right: 10px;">1.</td>
            @if ($surat->alasan == 'Choice 1')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa Saudara/i {{ $surat->karyawan->nama }}
                    Telah meninggal dunia
                </td>
            @elseif ($surat->alasan == 'Choice 2')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa Saudara/i {{ $surat->karyawan->nama }}
                    telah ditahan pihak yang berwajib</td>
            @elseif ($surat->alasan == 'Choice 3')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa Saudara/i {{ $surat->karyawan->nama }}
                    telah melanggar peraturan perusahaan</td>
            @elseif ($surat->alasan == 'Choice 4')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa Saudara/i {{ $surat->karyawan->nama }}
                    telah melakukan Pelanggaran bersifat mendesak</td>
            @elseif ($surat->alasan == 'Choice 5')
                <td colspan="3" align="justify" vertical-align= "top;">Adanya putusan lembaga penyelesaian
                    perselisihan hubungan industrial </td>
            @elseif ($surat->alasan == 'Choice 6')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa Sdr/i {{ $surat->karyawan->nama }} telah
                    memasuki Usia Pensiun</td>
            @elseif ($surat->alasan == 'Choice 7')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa Sdr/i {{ $surat->karyawan->nama }}
                    mengalami sakit berkepanjangan</td>
            @elseif ($surat->alasan == 'Choice 8')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa Sdr/i {{ $surat->karyawan->nama }} telah
                    mangkir 5 hari kerja atau lebih berturut-turut </td>
            @elseif ($surat->alasan == 'Choice 9')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa Sdr/i {{ $surat->karyawan->nama }}
                    telah mengundurkan Diri </td>
            @elseif ($surat->alasan == 'Choice 10')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa Jangka waktu perjanjian kerja waktu
                    tertentu Sdr/i {{ $surat->karyawan->nama }} telah berakhir</td>
            @elseif ($surat->alasan == 'Choice 11')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa masa probation (probation) Sdr/i
                    {{ $surat->karyawan->nama }} telah berakhir</td>
            @elseif ($surat->alasan == 'Choice 12')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa Perusahaan melakukan Merger/ Akuisisi
                </td>
            @elseif ($surat->alasan == 'Choice 13')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa Perusahaan melakukan Efisiensi </td>
            @elseif ($surat->alasan == 'Choice 14')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa karena keadaan memaksa (Force majeure)
                </td>
            @elseif ($surat->alasan == 'Choice 15')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa Perusahaan mengalami Pailit </td>
            @elseif ($surat->alasan == 'Choice 16')
                <td colspan="3" align="justify" vertical-align= "top;">Bahwa Perusahaan mengalami kerugian </td>
            @endif
        </tr>
        <tr>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td colspan="1" style="padding-right: 40px;" vertical-align= "top;">Mengingat</td>
            <td colspan="3" vertical-align= "top;" style="padding-right: 20px;">:</td>
            <td style="padding-right: 10px;">1.</td>
            <td colspan="3" align="justify" vertical-align= "top;">Adanya pemberian kuasa dan kewenangan dari
                {{ $surat->karyawan->masterBranchFranchises->nama_pt ?? '' }} kepada PT Sumber Alfaria Trijaya Tbk
                untuk melaksanakan
                tindakan-tindakan terkait dengan karyawan penerima waralaba yang diperlukan sebagaimana dimaksud di
                dalam Perjanjian Waralaba antara {{ $surat->karyawan->masterBranchFranchises->nama_pt ?? '' }} dengan
                PT Sumber Alfaria Trijaya
                Tbk.
            </td>
        </tr>
        <tr>
            <td colspan="1" style="padding-right: 40px;"></td>
            <td colspan="3" vertical-align= "top;" style="padding-right: 20px;"></td>
            <td style="padding-right: 10px;">2.</td>
            @if ($surat->karyawan->jenis_pkwt == 'PKWT')
                <td align="justify" colspan="3">Perjanjian Kerja Waktu Tertentu (PKWT) No
                    {{ $surat->karyawan->no_pkwt }}
                    tanggal {{ Carbon\Carbon::parse($surat->tgl_pkwt)->translatedFormat('j F Y', 'id') }} atas nama
                    Sdr/i {{ $surat->karyawan->nama }}</td>
                </td>
            @elseif ($surat->karyawan->jenis_pkwt == 'PKWTT')
                <td align="justify" colspan="3">Perjanjian Kerja Waktu Tertentu (PKWT) No
                    {{ $surat->karyawan->no_pkwt }}
                    tanggal {{ Carbon\Carbon::parse($surat->karyawan->tgl_pkwt)->translatedFormat('j F Y', 'id') }}
                    atas nama
                    Sdr/i {{ $surat->karyawan->nama }}</td>
                </td>
                </td>
                </td>
            @endif
        </tr>
        <tr>
            <td colspan="1" style="padding-right: 40px;"></td>
            <td colspan="3" style="padding-right: 20px;"></td>
            <td style="padding-right: 10px;">3.</td>
            <td colspan="2" align="justify">Peraturan Perundang – undangan yang berlaku
            </td>
        </tr>
        <tr>
            <td>
                <p></p>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-right: 40px;">Memutuskan</td>
            <td style="padding-right: 20px;">:</td>
            <td style="padding-right: 10px;"></td>
        </tr>
    </table>
    <table align="center">
        <tr>
            <td>
                <p>{{ $surat->karyawan->nama }}</p>
            </td>
        </tr>
    </table>
    <div align="justify">
        <p>
            Tempat dan tanggal lahir di {{ $surat->karyawan->tempat_lahir }},
            {{ \Carbon\Carbon::parse($surat->karyawan->tanggal_lahir)->isoFormat('D MMMM Y', 'Do MMMM Y') }},
            pendidikan terakhir
            {{ $surat->karyawan->pendidikan }}, mulai bekerja sejak tanggal
            {{ Carbon\Carbon::parse($surat->karyawan->tgl_awal_hubker)->translatedFormat('j F Y', 'id') }}, yang
            bersangkutan
            berstatus sebagai karyawan {{ $surat->karyawan->masterBranchFranchises->nama_pt ?? '' }} yang ditempatkan
            di Toko
            {{ $surat->karyawan->toko->nama_toko ?? '' }} {{ $surat->karyawan->toko->alamat ?? '' }}, jabatan
            {{ $surat->karyawan->jabatan }},
            dengan NIK {{ rc4_decrypt($surat->karyawan->nik) }}.
            <br>
            Terhitung sejak tanggal
            {{ Carbon\Carbon::parse($surat->karyawan->tgl_awal_hubker)->translatedFormat('j F Y', 'id') }}, hubungan
            kerja Sdr/i
            dengan {{ $surat->karyawan->masterBranchFranchises->nama_pt ?? '' }} dinyatakan berakhir, sehingga segala
            tindakan yang dilakukan oleh
            Sdr/i tidak memiliki sangkut paut dengan {{ $surat->karyawan->masterBranchFranchises->nama_pt ?? '' }} dan
            PT. Sumber Alfaria Trijaya
            Tbk.
            <br>
            Demikian Surat Keputusan ini dibuat, untuk dipergunakan sebagaimana mestinya. Apabila dikemudian hari
            terdapat kesalahan dalam pembuatan surat keputusan ini, maka akan diperbaiki sebagaimana mestinya.
        </p>
    </div>
    <table align="left">
        <tr>
            <td>{{ $surat->karyawan->masterBranchRegulars->kota }},
                {{ Carbon\Carbon::parse($surat->created_at)->translatedFormat('j F Y', 'id') }}</td>
        </tr>
        <tr>
            <td>Untuk dan atas nama {{ $surat->karyawan->masterBranchFranchises->nama_pt ?? '' }}
            </td>
        </tr>
        <tr>
            <td>
                <br>
            </td>
        </tr>
        <tr>
            <td>
                <br>
            </td>
        </tr>
        <tr>
            <td>
                <br>
            </td>
        </tr>
        <tr>
            <td>
                <u>
                    <b>{{ $surat->masterTtd->nama ?? '' }}</b>
                </u>
            </td>
        </tr>
        <tr>
            <td><b>{{ $surat->masterTtd->jabatan ?? '' }}</b></td>
        </tr>
        <tr>
        <tr>
            <td>
                <br>
            </td>
        </tr>
        <tr>
            <td class="tembusan">
                Tembusan:
            </td>
        </tr>
        <tr>
            <td>
                1. Arsip
            </td>
        </tr>
        <tr>
            <td>
                2. {{ $surat->karyawan->masterBranchFranchises->nama_pt ?? '' }}
            </td>
        </tr>
        <br>
        <tr>
            <td>
                <img src="data:image/png;base64, {!! base64_encode(
                    QrCode::format('svg')->size(40)->errorCorrection('H')->generate('SKBHK 003 - '),
                ) !!}">
            </td>
        </tr>
    </table>
</body>

</html>
