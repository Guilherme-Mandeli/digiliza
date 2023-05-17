document.addEventListener('DOMContentLoaded', ( e ) => {

	// CRIAR LINKS ANCORAS E LISTA NO RIGHTBAR
	// function createPostAnchors() {
	// 	// Pai do conteudo
	// 	let post = document.querySelector('#post_content');
		
	// 	// Verifica se existe conteudo e finaliza a funcao
	// 	if ( post.length )
	// 		return;
		
	// 		// Lista de titulos h2 e h3
	// 	let postTitleList = post.querySelectorAll('h2, h3');
	// 	// Nova lista para os links ancoras
	// 	const index = document.createElement('ul');
	// 	index.setAttribute('class', 'ps-0');
	// 	// Lista de elementos com ID carregados
	// 	let ElementsWithID = document.querySelectorAll('[id]');
	// 	// IDs carregados
	// 	var IDList = [];

	// 	// Preenche a lista com todos os IDs carregados
	// 	ElementsWithID.forEach ( elementWithID => {
	// 		IDList.push( elementWithID.id );
	// 	});

	// 	// Loop dos Titulos
	// 	postTitleList.forEach ( ( title, j ) => {

	// 		let anchor = document.createElement('dfn');
	// 		anchor.style.paddingTop = "80px";
			
	// 		let titleTxt = title.textContent;
	// 		let slug = string_to_slug( titleTxt );

	// 		let li = document.createElement('li');
	// 		let a = document.createElement('a');
			
	// 		// Verifica os IDs existentes
	// 		if ( IDList.includes(slug) ) {
	// 			anchor.setAttribute('id', `${slug}`);
	// 			a.setAttribute('href', `#${slug}`);
	// 		} else {
	// 			// Adiciona um identificador
	// 			anchor.setAttribute('id', `${slug}-${j + 1}`);
	// 			a.setAttribute('href', `#${slug}-${j + 1}`);
	// 		}

	// 		// Coloca a ancora no titulo
	// 		title.appendChild(anchor);

	// 		a.textContent = titleTxt;

	// 		li.appendChild(a);

	// 		// Cria estrutura de sublista
	// 		if (title.nodeName == 'H3') {
	// 			let ulNested = document.createElement('ul');
	// 			let liNested = document.createElement('li');
	// 			index.lastChild.appendChild( ulNested );
	// 			ulNested.appendChild( liNested );
	// 			liNested.appendChild( a );
	// 		} else {
	// 			index.appendChild( li );
	// 			if (title.nextElementSibling && title.nextElementSibling.nodeName === 'H3') {
	// 				liNested.appendChild( ulNested );
	// 				ul.appendChild( liNested );
	// 			}
	// 		}

	// 	});

	// 	let dynamicIndex = document.querySelector('#dynamic_index');
		
	// 	// Imprime a estrutura criada
    // 	dynamicIndex.appendChild( index );

	// }
	// createPostAnchors();

	// Adiciona padding-top ao Rightbar
	function setRightbarDistFromTop() {
		
		let rightbar = document.querySelector('#rightbar');
		
		if ( window.innerWidth < 992 ) {
			rightbar.style.marginTop = '0px';
			rightbar.classList.remove('sticky');
			rightbar.style.position = 'relative';
			return;
		}
		
		let contentPage = document.querySelector('#content_container');
		let contentBox = document.querySelector('#content');
		
		//Verifica se existem os elementos
		if ( !contentBox && !rightbar )
			return;

		//Verifica se existem o container da pagina
		if ( !contentPage ) {
			// Adiciona a altura sem considerar o container
			var contentBoxTopDistance = window.pageYOffset + contentBox.getBoundingClientRect().top - 78;
		} else {
			// Adiciona a altura considerando o margin e padding do container
			var marginTop = parseInt( getComputedStyle( contentPage ).marginTop );
			var paddingTop = parseInt( getComputedStyle( contentPage ).paddingTop );
			
			var contentBoxTopDistance = window.pageYOffset + contentBox.getBoundingClientRect().top - marginTop - paddingTop;
		}
		
		// Deixa o rightbar fixo na tela quando desceu certa distancia
		if ( scrollY >= contentBoxTopDistance )
			rightbar.classList.add('sticky');

		window.addEventListener('scroll', () => {
			if ( !rightbar || window.innerWidth < 992) {
				rightbar.style.marginTop = '0px';
				rightbar.classList.remove('sticky');
				rightbar.style.position = 'relative';
				return;
			}
			
			if ( scrollY >= contentBoxTopDistance )
				rightbar.classList.add('sticky');
			else
				rightbar.classList.remove('sticky');
		});
		
		// Aplica o estilo padding-top no Rightbar
		if ( rightbar !== null ) {
			rightbar.style.marginTop = `${contentBoxTopDistance}px`;
		}
	}
	setRightbarDistFromTop();

	window.addEventListener('resize', setRightbarDistFromTop);

	/**CONFIGURA OS ATRIBUTOS DA CLASSE .post_alert
	* Atributo border-color="[cssColor]"
	* Atributo icon-color="[cssColor]"
	*/
	function setPostAlertAttrs(){
		let alerts = document.querySelectorAll('.post_alert');
		
		// Verifica se há alertas
		if ( alerts.length <= 0 )
			return;

		alerts.forEach ( alert => {
			// Verifica se existe o atributo border-color
			if ( alert.hasAttribute('border-color') )
				// Adiciona a cor da borda
				alert.style.borderColor = alert.getAttribute('border-color');

			// Verifica se existe o atributo icon-color
			if ( alert.hasAttribute('icon-color') )
				// Encontra o icone dentro de .post_alert_icon e adiciona a cor
				alert.querySelector('.post_alert_icon i').style.color = alert.getAttribute('icon-color');
		});
	}
	setPostAlertAttrs();

});

function string_to_slug( str ) {

	return  str.toLowerCase()
	.replace(/[àÀáÁâÂãäÄÅåª]+/g, 'a')       // Special Characters #1
	.replace(/[èÈéÉêÊëË]+/g, 'e')       	// Special Characters #2
	.replace(/[ìÌíÍîÎïÏ]+/g, 'i')       	// Special Characters #3
	.replace(/[òÒóÓôÔõÕöÖº]+/g, 'o')       	// Special Characters #4
	.replace(/[ùÙúÚûÛüÜ]+/g, 'u')       	// Special Characters #5
	.replace(/[ýÝÿŸ]+/g, 'y')       		// Special Characters #6
	.replace(/[ñÑ]+/g, 'n')       			// Special Characters #7
	.replace(/[çÇ]+/g, 'c')       			// Special Characters #8
	.replace(/[ß]+/g, 'ss')       			// Special Characters #9
	.replace(/[Ææ]+/g, 'ae')       			// Special Characters #10
	.replace(/[Øøœ]+/g, 'oe')       		// Special Characters #11
	.replace(/[%]+/g, 'pct')       			// Special Characters #12
	.replace(/\s+/g, '-')           		// Replace spaces with -
    .replace(/[^\w\-]+/g, '')       		// Remove all non-word chars
    .replace(/\-\-+/g, '-')         		// Replace multiple - with single -
    .replace(/^-+/, '')             		// Trim - from start of text
    .replace(/-+$/, '');            		// Trim - from end of text
}