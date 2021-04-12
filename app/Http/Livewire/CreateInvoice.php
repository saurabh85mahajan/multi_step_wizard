<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\Invoice;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class CreateInvoice extends Component
{
    public $totalSteps = 3;
    public $step = 1;

    //Fields to store
    public $customer_id = '';
    public $isFixed = true;
    public $amount = 0;
    public $hours = 0;
    public $rate = 0;
    public $calculatedAmount = 0;
    public $message = '';

    protected $rules = [
        'customer_id' => 'required',
        'isFixed' => 'required|boolean',
        'amount' => 'required|numeric|gt:0',
        'hours' => 'numeric|gt:0',
        'rate' => 'numeric|gt:0',
        'message' => 'required|min:20',
    ];

    protected $messages = [
        'customer_id.required' => 'Please select Customer.',
        'amount.required' => 'Please enter Amount.',
        'rate.gt' => 'Hourly Rate must be greater than 0.',
        'message.required' => 'Please add Message for Customer.',
    ];

    public function render()
    {

        $customers = Customer::orderBy('full_name')->pluck('full_name', 'id');
        return view('livewire.invoices.index', [
            'customers' => $customers
        ]);
    }

    public function moveAhead()
    {
        if($this->step == 1) {
            //Validate Step 1 Data
            $this->validateOnly('customer_id');
            //Wont reach here if the Validation Fails.
            //Reset Error Bag to clear any errors on Step 2. 
            $this->resetErrorBag();
            //Recalculate Amount for Step 2.
            $this->_calculateAmount();
        }

        if($this->step == 2) {
            if($this->isFixed) {
                //Fixed Invoice Validation
                $this->validateOnly('amount');
            } else {
                //Hourly Invoice Validation
                $this->validateOnly('hours');
                $this->validateOnly('rate');
            }
            //Reset Error Bag to clear any errors on Step 3. 
            $this->resetErrorBag(); 
        }

        if($this->step == 3) {
            $this->validateOnly('message');
            //Save to the Invoice Model
            $invoice = new Invoice;
            $invoice->customer_id = $this->customer_id;
            $invoice->is_fixed = $this->isFixed;
            if($invoice->is_fixed ) {
                $invoice->amount = $this->amount;
            } else {
                $invoice->hours = $this->hours;
                $invoice->rate = $this->rate;
                $invoice->amount = $this->calculatedAmount;
            }
            $invoice->message = $this->message;
            $invoice->save();

            //redirect
            redirect()->route('dashboard');
        }

        //Increase Step
        $this->step += 1;
        $this->_validateStep();
    }

    public function moveBack()
    {
        $this->step -= 1;
        $this->_validateStep();
    }

    private function _validateStep()
    {
        if ($this->step < 1) {
            $this->step = 1;
        }

        if ($this->step > $this->totalSteps) {
            $this->step = $this->totalSteps;
        }
    }

    public function updatedHours($value)
    {
        //
        $this->calculatedAmount = 0;
        $this->validateOnly('hours');
        $this->_calculateAmount();
    }

    public function updatedRate($value)
    {
        //
        $this->calculatedAmount = 0;
        $this->validateOnly('rate');
        $this->_calculateAmount();

    }

    private function _calculateAmount()
    {
        if (is_numeric($this->hours) && is_numeric($this->rate)) {
            $this->calculatedAmount = $this->hours * $this->rate;
        } else {
            $this->calculatedAmount = 0;
        }
    }
}