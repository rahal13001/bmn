<?php

namespace App\Livewire;

use App\Models\Borrow;
use App\Models\Good;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class PublicLandingPage extends Component
{
    use WithFileUploads;

    public $borrower;
    public $borrower_phone;
    public $borrower_email;
    public $borrower_address;
    
    public $need;
    public $borrow_date;
    public $return_date;
    
    public $borrowGoods = [
        ['good_id' => '']
    ];
    
    public $application_letter;
    
    public $successMessage = '';

    protected function rules()
    {
        return [
            'borrower' => 'required|string|max:255',
            'borrower_phone' => 'required|string|max:255',
            'borrower_email' => 'required|email|max:255',
            'borrower_address' => 'required|string',
            'need' => 'required|string|max:255',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
            'borrowGoods' => 'required|array|min:1',
            'borrowGoods.*.good_id' => 'required|exists:goods,id',
            'application_letter' => 'required|file|mimes:pdf|max:10240',
        ];
    }

    protected function messages()
    {
        return [
            'borrower.required' => 'Nama Pemohon wajib diisi.',
            'borrower_phone.required' => 'Nomor HP/WA wajib diisi.',
            'borrower_email.required' => 'Email wajib diisi.',
            'borrower_email.email' => 'Format email tidak valid.',
            'borrower_address.required' => 'Alamat Peminjam wajib diisi.',
            'need.required' => 'Keperluan (kegiatan) wajib diisi.',
            'borrow_date.required' => 'Tanggal Pinjam wajib diisi.',
            'return_date.required' => 'Tanggal Rencana Kembali wajib diisi.',
            'borrowGoods.*.good_id.required' => 'Harap pilih minimal satu barang BMN.',
            'application_letter.required' => 'Surat permohonan wajib diupload.',
            'application_letter.mimes' => 'Format file harus PDF.',
            'application_letter.max' => 'Ukuran file maksimal 10MB.',
        ];
    }

    public function addGood()
    {
        $this->borrowGoods[] = ['good_id' => ''];
    }

    public function removeGood($index)
    {
        unset($this->borrowGoods[$index]);
        $this->borrowGoods = array_values($this->borrowGoods); 
        
        if (empty($this->borrowGoods)) {
            $this->addGood();
        }
    }

    public function submit()
    {
        $this->validate();

        // Extra Validation: Ensure selected goods are still available
        if ($this->borrow_date && $this->return_date) {
            $bookedIds = \App\Filament\Resources\BorrowResource::getBorrowedGoodIds($this->borrow_date, $this->return_date, null);
            
            foreach ($this->borrowGoods as $item) {
                if (in_array($item['good_id'], $bookedIds)) {
                    $this->addError("borrowGoods", "Beberapa barang yang Anda pilih sudah dipesan pada tanggal tersebut. Silakan periksa kembali daftar barang.");
                    return;
                }
            }
        }

        DB::transaction(function () {
            // Store Document
            $letterPath = $this->application_letter->store('documentation/borrows/application_letter', 'public');

            // Create Borrow Request
            $borrow = Borrow::create([
                'officer' => null,
                'borrower_type' => 'external',
                'status' => 'pending',
                'borrower' => $this->borrower,
                'borrower_phone' => $this->borrower_phone,
                'borrower_email' => $this->borrower_email,
                'borrower_address' => $this->borrower_address,
                'need' => $this->need,
                'borrow_date' => $this->borrow_date,
                'return_date' => $this->return_date,
                'application_letter' => $letterPath,
            ]);

            // Attach Pivot tables
            foreach ($this->borrowGoods as $item) {
                $borrow->borrowGoods()->create([
                    'good_id' => $item['good_id'],
                    'borrow_condition' => 'Menunggu pengecekan Admin',
                ]);
            }
        });

        $this->reset([
            'borrower', 'borrower_phone', 'borrower_email', 'borrower_address',
            'need', 'borrow_date', 'return_date', 'borrowGoods', 'application_letter'
        ]);
        $this->borrowGoods = [['good_id' => '']];
        
        $this->dispatch('borrow-success', [
            'message' => 'Permohonan peminjaman berhasil dikirim. Silakan tunggu konfirmasi dari admin.'
        ]);
    }

    public function render()
    {
        // Compute available goods based on currently selected dates
        $availableGoods = collect();
        
        if ($this->borrow_date && $this->return_date) {
            $bookedIds = \App\Filament\Resources\BorrowResource::getBorrowedGoodIds($this->borrow_date, $this->return_date, null);
            $availableGoods = collect(Good::all()->mapWithKeys(function ($good) use ($bookedIds) {
                $label = $good->full_name;
                $disabled = false;
                if (in_array($good->id, $bookedIds)) {
                    $label .= ' (Sedang Dipinjam)';
                    $disabled = true;
                }
                return [$good->id => ['label' => $label, 'disabled' => $disabled]];
            }));
        } else {
            $availableGoods = collect(Good::all()->mapWithKeys(function ($good) {
                return [$good->id => ['label' => $good->full_name, 'disabled' => false]];
            }));
        }

        return view('livewire.public-landing-page', [
            'availableGoods' => $availableGoods
        ])->layout('components.layouts.app');
    }
}
