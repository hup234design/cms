<?php

namespace Hup234design\Cms\Http\Livewire;

use Filament\Forms;
use Hup234design\Cms\Models\Enquiry;
use Livewire\Component;
use Spatie\Honeypot\Exceptions\SpamException;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;
use Spatie\Honeypot\SpamProtection;

class EnquiryForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;
    use UsesSpamProtection;

    public $x = 20;
    public $y = 5;
    public $answer = 15;

    public $submitted = false;

    public HoneypotData $extraFields;

    public function resetQuiz()
    {
        $this->x = rand(10,20);
        $this->y = rand(1,5);
    }

    public function mount(): void
    {
        $this->resetQuiz();

        $this->extraFields = new HoneypotData();
        $this->form->fill([
            'first_name' => 'Dave',
            'last_name'  => 'Walker',
            'email'      => 'dave@hup234design.co.uk',
            'telephone'  => '07887477234',
            'services'   => ['Service Two', 'Other'],
            'subject'    => 'Testing SPAM Honeypot',
            'message'    => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor',
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\TextInput::make('first_name')->required(),
                    Forms\Components\TextInput::make('last_name')->required(),
                ])
                ->columns(2),
            Forms\Components\TextInput::make('email')->email()->required(),
            Forms\Components\TextInput::make('telephone')
                ->tel()
                ->nullable()
                ->helperText('Optional'),
            Forms\Components\TextInput::make('subject')->required(),
            Forms\Components\Textarea::make('message')
                ->rows(5)
                //->maxLength(app(CmsSettings::class)->enquiries_max_characters)
                ->required(),
            Forms\Components\Textinput::make('quiz')
                ->label('What is '.$this->x.' - '.$this->y.' ?')
                ->required()
                ->rules([
                    function () {
                        return function ($attribute, $value, \Closure $fail) {
                            if ($value != $this->x - $this->y) {
                                $fail("That answer is incorrect.");
                            }
                        };
                    }
                ])
            //->helperText('Max ' . app(CmsSettings::class)->enquiries_max_characters . ' characters'),
        ];
    }

    protected function getFormModel(): string
    {
        return Enquiry::class;
    }

    public function submit(): void
    {
        $this->validate();
        $this->submitted = true;
        $data = $this->form->getState();
        $data['ip_address'] = request()->ip();
        $honeypotData = $this->guessHoneypotDataProperty();
        try {
            app(SpamProtection::class)->check($honeypotData->toArray());
        } catch (SpamException) {
            $data['spam'] = true;
        }
        $enquiry = Enquiry::create($data);
    }

    public function render()
    {
        return view('cms::livewire.enquiry-form');
    }
}
