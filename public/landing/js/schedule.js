document.addEventListener('DOMContentLoaded', (e) => {

    function enableScheduleForm() {

        let form = document.querySelector('form[name="schedule-form"');

        if (!form)
            return;

        let dataInput = document.querySelector('#basic-datepicker2');
        let hourInput = document.querySelector('select[name="hour"]');
        let submit = document.querySelector('#schedule-submit');
        let hourAlert = document.querySelector('#schedule-hour-alert');

        $(dataInput).change(function () {
            if (dataInput.value) {
                hourInput.removeAttribute('disabled');
                submit.removeAttribute('disabled');
                hourAlert.style.display = "none";
            } else {
                hourInput.setAttribute('disabled', 'disabled');
                submit.setAttribute('disabled', 'disabled');
                hourAlert.style.display = "block";
            }
        });

    }
    enableScheduleForm();

    // Obtenha o campo de data e o seletor de horário
    const dateInput = document.querySelector('#basic-datepicker2');
    const hourSelect = document.querySelector('select[name="hour"]');
    

    // Função para atualizar a lista de horários quando a data for alterada
    function updateHourList() {
        const selectedDate = dateInput.value;

        // Verificar se a data foi selecionada
        if ( selectedDate ) {

            hourSelect.disabled = true;

            // Fazer uma requisição AJAX para obter os horários agendados para a data selecionada
            // e atualizar as opções do select 'hour' com base nos resultados
            axios.get( '/get-schedule', {
                params: {
                    date: selectedDate
                }
            })
                .then(function (response) {
                    const hourList = response.data.hourList; // Array de horários obtidos da resposta
                    const allHours = ['18:00', '18:45', '19:30', '20:15', '21:00', '21:45', '22:30', '23:15', '23:59'];

                    // Limpar as opções existentes
                    hourSelect.innerHTML = '<option value="">Selecione um horário</option>';

                    function isHourDisabled(hour) {
                        return hourList.includes(hour);
                    }

                    // Preencher as opções do select 'hour'
                    allHours.forEach((hour) => {
                        const disabled = isHourDisabled(hour);
                        const option = `<option value="${hour}" ${disabled ? 'disabled="disabled"' : ''}>${hour} ${disabled ? '- Indisponível' : ''}</option>`;
                        hourSelect.innerHTML += option;
                    });

                    hourSelect.disabled = false; // Habilitar o select 'hour'
                    document.getElementById('schedule-hour-alert').style.display = 'none'; // Esconder a mensagem de alerta

                    
                })
                .catch(function (error) {
                    console.log('Erro ao obter os horários agendados:', error);
                });
        } else {
            // Caso a data não seja selecionada, desabilitar o select 'hour' e limpar as opções
            hourSelect.innerHTML = '<option value="">Selecione um horário</option>';
            hourSelect.disabled = true;
            document.getElementById('schedule-hour-alert').style.display = 'block'; // Mostrar a mensagem de alerta
        }
    }

    // Função para validar o formulário antes de enviá-lo
    function validateForm() {
        const selectedHour = hourSelect.value;

        if (!selectedHour) {
            alert('Selecione um horário válido.');
            return false;
        }

        return true;
    }

    // Adicionar um ouvinte de evento ao campo de data para chamar a função 'updateHourList' quando a data for alterada
    if( dateInput ) {
        dateInput.addEventListener('changeDate', updateHourList);

        // Inicializar o flatpicker
        flatpickr(dateInput, {
            dateFormat: 'd/m/Y',
            onChange: function (selectedDates) {
            updateHourList(selectedDates[0]);
            }
        });
    }

    function controllerHourSelect() {
        const dateInput = document.querySelector('#basic-datepicker2');
        const hourSelect = document.querySelector('select[name="hour"]');
      
        const observer = new MutationObserver((mutationsList) => {
          for (const mutation of mutationsList) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
              const isActive = dateInput.classList.contains('active');
              hourSelect.disabled = isActive;
              break;
            }
          }
        });
      
        observer.observe(dateInput, { attributes: true });
      
        // Defina o estado inicial do hourSelect com base na classe ativa do dateInput
        hourSelect.disabled = dateInput.classList.contains('active');
      }
      
      controllerHourSelect();
});