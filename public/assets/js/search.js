document.addEventListener('DOMContentLoaded', ( e ) => {

	function setTopbarSearchWidth(){
		// if( window.innerWidth < 992 ){
		// 	let searchWrapper = document.querySelector('#navbar_search');
		// 	searchWrapper.classList.add('touch-search')
		// 	return;
		// }

		let reference = document.querySelector('#post_content');
		let search = document.querySelector('.navbar-custom #top-search');

		if( !reference && !search )
			return;

		// search.style.width = `${reference.offsetWidth - 24}px`;
	}
	setTopbarSearchWidth();
	
	window.addEventListener('resize', setTopbarSearchWidth);


	function setTopbarSearchDistance(){
		let search = document.querySelector('.navbar-custom #search_app');

		if( window.innerWidth < 992 ) {
			search.style.position = "absolute";
			search.style.top = "3px";
			return;
		}

		
		if( search.style.position != "absolute" );
			search.style.position = "absolute";
		
		if( window.scrollY <= 0 )
			search.style.top = "60px";
		else
			search.style.top = "0px";

	}
	setTopbarSearchDistance();

	window.addEventListener('scroll', setTopbarSearchDistance);
	window.addEventListener('resize', setTopbarSearchDistance);
	
	// Toggle lightbox seach
	// function toggleSearchLightbox(  ) {

	// 	if( window.innerWidth < 992) {
	// 		document.querySelector('#navbar_search').addEventListener('click', ( e ) => {
	// 			if( e.target.id == "search_app") {
	// 				document.querySelector('#navbar_search.touch-search').classList.remove('opened');
	// 				document.querySelector('body').style.overflowY = 'auto';
	// 			}
				
	// 			if( e.target.id == "navbar_search") {
	// 				document.querySelector('#navbar_search.touch-search').classList.add('opened');
	// 				document.querySelector('body').style.overflowY = 'hidden';
	// 			}
		
	// 		});
	// 	} else {
	// 		// Desativa o estilo mobile
	// 		document.querySelector('#navbar_search').classList.remove('touch-search');
	// 		// Acionado quando redimenciona de mobile para desktop com o lightbox aberto
	// 		if( document.querySelector('#navbar_search').classList.contains('opened') ) {
	// 			document.querySelector('#navbar_search').classList.remove('opened');
	// 			document.querySelector('body').style.overflowY = 'auto';
	// 		}
	// 		setTopbarSearchDistance();
	// 	}
	// }
	// toggleSearchLightbox();
	
	// window.addEventListener('resize', toggleSearchLightbox);

});