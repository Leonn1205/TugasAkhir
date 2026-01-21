<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TempatWisata;
use App\Models\TempatKuliner;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ExportController extends Controller
{
    public function exportExcel($tipe)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        if ($tipe == 'wisata') {
            $data = TempatWisata::with(['jamOperasionalAdmin', 'kategori'])->get();

            // Header kolom
            $headers = [
                'No',
                'Nama Wisata',
                'Kategori',
                'Alamat Lengkap',
                'Longitude',
                'Latitude',
                'Jam Operasional',
                'Status'
            ];
            $sheet->fromArray([$headers], null, 'A1');

            // Styling header
            $headerStyle = [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2E7D32']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
            ];
            $sheet->getStyle('A1:H1')->applyFromArray($headerStyle);

            $row = 2;
            $no = 1;
            foreach ($data as $item) {
                // Gabungkan kategori dengan koma
                $kategoriList = $item->kategori->pluck('nama_kategori')->join(', ');
                if (empty($kategoriList)) {
                    $kategoriList = 'Tidak ada kategori';
                }

                // Gabungkan jam operasional dengan newline
                $jamOperasional = '';
                if ($item->jamOperasionalAdmin && $item->jamOperasionalAdmin->count() > 0) {
                    foreach ($item->jamOperasionalAdmin as $jam) {
                        if ($jam->libur) {
                            $jamOperasional .= "{$jam->hari}: Libur\n";
                        } else {
                            $jamBuka = $jam->jam_buka ? $jam->jam_buka->format('H:i') : '-';
                            $jamTutup = $jam->jam_tutup ? $jam->jam_tutup->format('H:i') : '-';
                            $jamOperasional .= "{$jam->hari}: {$jamBuka} - {$jamTutup}\n";
                        }
                    }
                    $jamOperasional = trim($jamOperasional);
                } else {
                    $jamOperasional = 'Belum ada jadwal';
                }

                // Status
                $status = $item->status ? 'Aktif' : 'Tidak Aktif';

                // Isi data ke Excel
                $sheet->setCellValue("A$row", $no++);
                $sheet->setCellValue("B$row", $item->nama_wisata);
                $sheet->setCellValue("C$row", $kategoriList);
                $sheet->setCellValue("D$row", $item->alamat_lengkap ?? '-');
                $sheet->setCellValue("E$row", $item->longitude);
                $sheet->setCellValue("F$row", $item->latitude);
                $sheet->setCellValue("G$row", $jamOperasional);
                $sheet->setCellValue("H$row", $status);

                // Aktifkan wrap text untuk kolom alamat dan jam operasional
                $sheet->getStyle("D$row")->getAlignment()->setWrapText(true);
                $sheet->getStyle("G$row")->getAlignment()->setWrapText(true);

                // Border untuk setiap row
                $sheet->getStyle("A$row:H$row")->applyFromArray([
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
                ]);

                $row++;
            }

            $filename = "Data_Tempat_Wisata_" . date('Ymd_His') . ".xlsx";
        }

        elseif ($tipe == 'kuliner') {
            $data = TempatKuliner::with(['jamOperasionalAdmin', 'kategori'])->get();

            // Header kolom
            $headers = [
                'No',
                'Nama Sentra',
                'Kategori',
                'Pemilik',
                'Tahun Berdiri',
                'Alamat Lengkap',
                'Telepon',
                'Email',
                'Menu Unggulan',
                'Fasilitas Pendukung',
                'Jumlah Pegawai',
                'Jumlah Kursi',
                'Jam Operasional',
                'Latitude',
                'Longitude',
                'Status'
            ];
            $sheet->fromArray([$headers], null, 'A1');

            // Styling header
            $headerStyle = [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF'], 'size' => 12],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2E7D32']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
            ];
            $sheet->getStyle('A1:P1')->applyFromArray($headerStyle);

            $row = 2;
            $no = 1;
            foreach ($data as $item) {
                // Gabungkan kategori dengan koma
                $kategoriList = $item->kategori->pluck('nama_kategori')->join(', ');
                if (empty($kategoriList)) {
                    $kategoriList = 'Tidak ada kategori';
                }

                // Format fasilitas pendukung (array)
                $fasilitas = '';
                if (!empty($item->fasilitas_pendukung) && is_array($item->fasilitas_pendukung)) {
                    $fasilitas = implode(', ', $item->fasilitas_pendukung);
                } else {
                    $fasilitas = '-';
                }

                // Gabungkan jam operasional dengan newline
                $jamOperasional = '';
                if ($item->jamOperasionalAdmin && $item->jamOperasionalAdmin->count() > 0) {
                    foreach ($item->jamOperasionalAdmin as $jam) {
                        if ($jam->libur) {
                            $jamOperasional .= "{$jam->hari}: Libur\n";
                        } else {
                            $jamBuka = $jam->jam_buka ? $jam->jam_buka->format('H:i') : '-';
                            $jamTutup = $jam->jam_tutup ? $jam->jam_tutup->format('H:i') : '-';
                            $jamOperasional .= "{$jam->hari}: {$jamBuka} - {$jamTutup}\n";

                            // Tambahkan info jam sibuk jika ada
                            if ($jam->jam_sibuk_mulai && $jam->jam_sibuk_selesai) {
                                $jamSibukMulai = $jam->jam_sibuk_mulai->format('H:i');
                                $jamSibukSelesai = $jam->jam_sibuk_selesai->format('H:i');
                                $jamOperasional .= "   (Jam Sibuk: {$jamSibukMulai} - {$jamSibukSelesai})\n";
                            }
                        }
                    }
                    $jamOperasional = trim($jamOperasional);
                } else {
                    $jamOperasional = 'Belum ada jadwal';
                }

                // Status
                $status = $item->status ? 'Aktif' : 'Tidak Aktif';

                // Isi data ke Excel
                $sheet->setCellValue("A$row", $no++);
                $sheet->setCellValue("B$row", $item->nama_sentra);
                $sheet->setCellValue("C$row", $kategoriList);
                $sheet->setCellValue("D$row", $item->nama_pemilik ?? '-');
                $sheet->setCellValue("E$row", $item->tahun_berdiri ?? '-');
                $sheet->setCellValue("F$row", $item->alamat_lengkap ?? '-');
                $sheet->setCellValue("G$row", $item->telepon ?? '-');
                $sheet->setCellValue("H$row", $item->email ?? '-');
                $sheet->setCellValue("I$row", $item->menu_unggulan ?? '-');
                $sheet->setCellValue("J$row", $fasilitas);
                $sheet->setCellValue("K$row", $item->jumlah_pegawai ?? '-');
                $sheet->setCellValue("L$row", $item->jumlah_kursi ?? '-');
                $sheet->setCellValue("M$row", $jamOperasional);
                $sheet->setCellValue("N$row", $item->latitude);
                $sheet->setCellValue("O$row", $item->longitude);
                $sheet->setCellValue("P$row", $status);

                // Aktifkan wrap text untuk kolom yang panjang
                $sheet->getStyle("F$row")->getAlignment()->setWrapText(true); // Alamat
                $sheet->getStyle("I$row")->getAlignment()->setWrapText(true); // Menu
                $sheet->getStyle("J$row")->getAlignment()->setWrapText(true); // Fasilitas
                $sheet->getStyle("M$row")->getAlignment()->setWrapText(true); // Jam Operasional

                // Border untuk setiap row
                $sheet->getStyle("A$row:P$row")->applyFromArray([
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]]
                ]);

                $row++;
            }

            $filename = "Data_Tempat_Kuliner_" . date('Ymd_His') . ".xlsx";
        }

        else {
            return abort(404, 'Tipe export tidak dikenal.');
        }

        // Auto width untuk semua kolom agar lebih rapi
        foreach (range('A', $sheet->getHighestColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Set minimum width untuk kolom tertentu
        if ($tipe == 'wisata') {
            $sheet->getColumnDimension('D')->setWidth(30); // Alamat
            $sheet->getColumnDimension('G')->setWidth(25); // Jam Operasional
        } elseif ($tipe == 'kuliner') {
            $sheet->getColumnDimension('F')->setWidth(30); // Alamat
            $sheet->getColumnDimension('I')->setWidth(25); // Menu
            $sheet->getColumnDimension('J')->setWidth(25); // Fasilitas
            $sheet->getColumnDimension('M')->setWidth(30); // Jam Operasional
        }

        // Output file ke browser
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer->save('php://output');
        exit;
    }
}
