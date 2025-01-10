<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use Illuminate\Http\Request;

class RekapAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id = null)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $data = $id 
            ? Absensi::where('id_karyawan', $id) 
            : Absensi::query();

            
        if ($startDate && $endDate) {
            $data->whereBetween('created_at', [
                date('Y-m-d 00:00:00', strtotime($startDate)),
                date('Y-m-d 23:59:59', strtotime($endDate)),
            ]);
        } elseif ($endDate) {
            $data->where('created_at', '<=', date('Y-m-d 23:59:59', strtotime($endDate)));
        } elseif ($startDate) {
            $data->where('created_at', '>=', date('Y-m-d 00:00:00', strtotime($startDate)));
        }

        $data = $data->get()->sortByDesc('created_at');
        $rekapKaryawan = $this->calculateRekapKaryawan($data);

        $statusCounts = $data->groupBy('status')->map(function ($group) {
            return $group->count();
        });

        // Ensure the counts are properly initialized
        $hadirCount = $statusCounts->get('Hadir', 0);
        $telatCount = $statusCounts->get('Telat', 0);
        $absenCount = $statusCounts->get('Absen', 0);
        $totalEmployees = $data->count();

        return view('manajer.rekap', [
            'absensis' => $data,
            'rekapKaryawan' => $rekapKaryawan,
            'hadirCount' => $hadirCount,
            'telatCount' => $telatCount,
            'absenCount' => $absenCount,
            'totalEmployees' => $totalEmployees,
        ]);
    }


    /**
     * Calculate attendance summary for each employee.
     * 
     * @param \Illuminate\Support\Collection $data
     * @return \Illuminate\Support\Collection
     */
    private function calculateRekapKaryawan($data)
    {
        return $data->groupBy('id_karyawan')->map(function ($absensi) {
            $statusCounts = $absensi->groupBy('status')->map(function ($group) {
                return $group->count();
            });

            return [
                'Hadir' => $statusCounts->get('Hadir', 0),
                'Telat' => $statusCounts->get('Telat', 0),
                'Absen' => $statusCounts->get('Absen', 0),
                'Total' => $absensi->count(),
            ];
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(absensi $absensi)
    {
        //
    }
}
