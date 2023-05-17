document.addEventListener('DOMContentLoaded', ( e ) => {
	
	function selectMenuOption() {
		let menuSetter = document.getElementsByClassName('menu-config');
		let configDeep = menuSetter.length;
		
		if( configDeep <= 0 )
			return;

		for( let i = 0; i < configDeep; i++ ){
			try{
				document.getElementById( menuSetter[i].value ).classList.add('menuitem-active');
				
				if( document.getElementById( menuSetter[i].value ).querySelector('.collapse') )
					document.getElementById( menuSetter[i].value ).querySelector('.collapse').classList.add('show');
			}
			catch{
				//Ignora mensagens de erro
				//Ativado quando a configuração do menu é customizada (o id não está presente no menu)
			}
			
		}
	}
	selectMenuOption();

	// FILL BREADCRUMB
	function fillBreadcrumb() {
		const configs = document.getElementsByClassName('menu-config');
		const breadcrumbs = document.getElementsByClassName('breadcrumb');

		// Verifica todas as configurações e aplica em todos os Breadcrumbs presentes
		configs.forEach(( config, index ) => {
			breadcrumbs.forEach(( breadcrumb ) => {

				// Verifica se esta é a última configuração na lista de configurações
				const isLastElement = index === ( configs.length - 1 );

				// Obtem o texto e o URL do link para esta configuração
				let text = "", url = "";
				let item = document.querySelector(`#${config.value} a`);

				if( item == null ) {
					text = config.value;
					if( config.getAttribute('data-url') !== null && config.getAttribute('data-url') !== undefined )
						url = config.getAttribute('data-url');
				} else {
					text = item.text.trim();
					url = item.href;
				}

				
				if ( isLastElement || url == "#" || url == "" ) {
					breadcrumb.innerHTML += `<li class="breadcrumb-item active">${text}</li>`;
				} else {
					breadcrumb.innerHTML += `<li class="breadcrumb-item"><a href="${url}">${text}</a></li>`;
				}

			});
		});
	}
	fillBreadcrumb();

	// Arruma o responsivo do menu
	function setLeftNavSize() {

		let body = document.querySelector('body');
		
		if ( window.innerWidth > 992 && window.innerWidth < 1029 )
			body.setAttribute('data-sidebar-size', 'default');
			
	}
	setLeftNavSize();

	window.addEventListener('resize', setLeftNavSize);

});