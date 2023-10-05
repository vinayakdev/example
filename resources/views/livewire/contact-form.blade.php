<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    <section x-data="ContctForm">
        <div class="bg-green-300 max-w-md p-12" {{-- x-init="setTimeout(() => alert = false, 3000)" --}}>
            <div class="font-syne flex flex-col gap-[5cqw] md:gap-[1.2cqw] mt-[2cqw] md:mt-0">

                <div>
                    <label for="name">Full Name</label>
                    <input required type="text" id="name"
                        class="@error('name') border-black @else border-textGray @enderror" wire:model='name'>
                    @error('name')
                        <p class="text-white text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <p> This
                    site is protected by reCAPTCHA and the Google
                    <a aria-label="captcha" class="text-yellowtext font-medium"
                        href="https://policies.google.com/privacy" target="_blank"> Privacy Policy</a> and <a
                        aria-label=""class="text-yellowtext font-medium" href="https://policies.google.com/terms"
                        target="_blank">Terms of Service</a> apply.
                </p>
                <div class="flex justify-center items-center md:justify-start">
                    <button type="button" id="myButton1" type="button" id="feedback-recaptcha"
                        data-sitekey="{{ env('CAPTCHA_SITE_KEY') }}" data-action='submit'
                        class="g-recaptcha font-syne flex justify-center items-center font-semibold w-[30%] px-[6cqw] md:px-[1.8cqw] mt-[2cqw] hover:bg-white hover:text-black transition-all rounded-full py-[1cqw] md:py-[0.5cqw] border-[.1cqw] border-black bg-black text-white">
                        <p wire:loading.remove class="">
                            <span x-text='submit'></span>
                        </p>
                        <div wire:loading>
                            <div>
                                Loading..
                            </div>
                        </div>
                    </button>
                </div>
            </div>

            <div x-show='alert' class="fixed top-0 right-0 bg-black z-50  p-[4cqw] md:p-[2cqw]">
                <div
                    class="relative flex items-center justify-between gap-4 rounded-lg bg-lightGray px-[4cqw] md:px-[2cqw] py-[2cqw] md:py-[1cqw] text-white shadow-lg">
                    <p class=" text-[3.5cqw] md:text-[1cqw] 2xl:text-[0.9cqw] font-syne font-medium">

                    <p x-text='alert'></p>
                    </p>
                    <p x-text='message'></p>
                    </p>

                    <button @click="alert=false" aria-label="Close"
                        class="shrink-0 rounded-lg bg-black/10 p-1 transition hover:bg-black/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>


        </div>



        <div>
            <button x-bin:disabled='alert === true' @click="alert = true">
                Trigger Alert
            </button>
        </div>

    </section>

    <script async src="https://www.google.com/recaptcha/api.js?render={{ config('app.CAPTCHA_SITE_KEY') }}"></script>

    <script>
        document.getElementById('myButton1').addEventListener('click', function() {
            grecaptcha.ready(function() {
                grecaptcha.execute('{{ config('app.CAPTCHA_SITE_KEY') }}', {
                        action: 'submit'
                    })
                    .then(function(token) {
                        @this.set('captcha', token);
                    });
            });
        });

        document.addEventListener('alpine:init', () => {
            Alpine.data('ContctForm', () => ({

                submit: 'Submit',
                alert: false,
                message: '[message]',

                init() {
                    window.addEventListener('success', event => {
                        this.alert = true;
                        this.message = event.detail.message;
                        this.submit = 'Submitted';
                    });

                    this.$watch('alert', value => setTimeout(() => {
                        this.alert = false;
                    }, 2000));

                },


            }))
        })
    </script>


</div>
