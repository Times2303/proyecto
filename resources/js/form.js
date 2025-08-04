let steps = document.querySelectorAll('.step');
let num = steps.length;
let currentStep = 1;
    const form = document.getElementById('multi-step-form');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    const progressBar = document.getElementById('progress-bar');

    function showStep(step) {
        document.querySelectorAll('.step').forEach(s => s.classList.add('hidden'));
        document.getElementById(`step-${step}`).classList.remove('hidden');
        
        progressBar.style.width = `${(step / num) * 100}%`;
        for (let i = 1; i <= num; i++) {
            const stepIndicator = document.getElementById(`step${i}`);
            if (i <= step) {
                stepIndicator.classList.remove('opacity-50');
            } else {
                stepIndicator.classList.add('opacity-50');
            }
        }

        prevBtn.classList.toggle('hidden', step === 1);
        nextBtn.classList.toggle('hidden', step === num);
        submitBtn.classList.toggle('hidden', step !== num);
        }

    function validateStep(step) {
        const currentStepElement = document.getElementById(`step-${step}`);
        const inputs = currentStepElement.querySelectorAll('input[required], select[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value) {
                isValid = false;
                input.classList.add('border-red-500');
            } else {
                input.classList.remove('border-red-500');
            }
        });
        return isValid;
    }

    nextBtn.addEventListener('click', () => {
        if (validateStep(currentStep)) {
            currentStep++;
            showStep(currentStep);
        }
    });

    prevBtn.addEventListener('click', () => {
        currentStep--;
        showStep(currentStep);
    });

    showStep(currentStep);