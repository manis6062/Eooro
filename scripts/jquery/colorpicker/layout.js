(function($){
	var initLayout = function() {
		var hash = window.location.hash.replace('#', '');
		var currentTab = $('ul.navigationTabs a')
							.bind('click', showTab)
							.filter('a[rel=' + hash + ']');
		if (currentTab.size() == 0) {
			currentTab = $('ul.navigationTabs a:first');
		}
		showTab.apply(currentTab.get(0));

		$('#colorSelectorBackground').ColorPicker({
			color: '#'+$('#colorBackground').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorBackground span').css('backgroundColor', '#' + hex);
				$('#colorBackground').attr('value', hex);
			}
		});
		
		$('#colorSelectorHeader').ColorPicker({
			color: '#'+$('#colorHeader').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorHeader span').css('backgroundColor', '#' + hex);
				$('#colorHeader').attr('value', hex);
			}
		});
			
		$('#colorSelectorText').ColorPicker({
			color: '#'+$('#colorText').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorText span').css('backgroundColor', '#' + hex);
				$('#colorText').attr('value', hex);
			}
		});
		
		$('#colorSelectorLink').ColorPicker({
			color: '#'+$('#colorLink').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorLink span').css('backgroundColor', '#' + hex);
				$('#colorLink').attr('value', hex);
			}
		});
		
		$('#colorSelectorNavbar').ColorPicker({
			color: '#'+$('#colorNavbar').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorNavbar span').css('backgroundColor', '#' + hex);
				$('#colorNavbar').attr('value', hex);
			}
		});
		
		$('#colorSelectorNavbarLink').ColorPicker({
			color: '#'+$('#colorNavbarLink').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorNavbarLink span').css('backgroundColor', '#' + hex);
				$('#colorNavbarLink').attr('value', hex);
			}
		});
		
		$('#colorSelectorNavbarLinkActive').ColorPicker({
			color: '#'+$('#colorNavbarLinkActive').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorNavbarLinkActive span').css('backgroundColor', '#' + hex);
				$('#colorNavbarLinkActive').attr('value', hex);
			}
		});
		
		$('#colorSelectorFooter').ColorPicker({
			color: '#'+$('#colorFooter').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorFooter span').css('backgroundColor', '#' + hex);
				$('#colorFooter').attr('value', hex);
			}
		});
		
		$('#colorSelectorFooterText').ColorPicker({
			color: '#'+$('#colorFooterText').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorFooterText span').css('backgroundColor', '#' + hex);
				$('#colorFooterText').attr('value', hex);
			}
		});
		
		$('#colorSelectorFooterLink').ColorPicker({
			color: '#'+$('#colorFooterLink').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorFooterLink span').css('backgroundColor', '#' + hex);
				$('#colorFooterLink').attr('value', hex);
			}
		});
        
        $('#colorSelector1').ColorPicker({
			color: '#'+$('#color1').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelector1 span').css('backgroundColor', '#' + hex);
				$('#color1').attr('value', hex);
			}
		});
        
        $('#colorSelector2').ColorPicker({
			color: '#'+$('#color2').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelector2 span').css('backgroundColor', '#' + hex);
				$('#color2').attr('value', hex);
			}
		});
        
        $('#colorSelector3').ColorPicker({
			color: '#'+$('#color3').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelector3 span').css('backgroundColor', '#' + hex);
				$('#color3').attr('value', hex);
			}
		});
        
        $('#colorSelector4').ColorPicker({
			color: '#'+$('#color4').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelector4 span').css('backgroundColor', '#' + hex);
				$('#color4').attr('value', hex);
			}
		});
        
        $('#colorSelector5').ColorPicker({
			color: '#'+$('#color5').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelector5 span').css('backgroundColor', '#' + hex);
				$('#color5').attr('value', hex);
			}
		});
        
        $('#colorSelector6').ColorPicker({
			color: '#'+$('#color6').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelector6 span').css('backgroundColor', '#' + hex);
				$('#color6').attr('value', hex);
			}
		});
        
        $('#colorSelector7').ColorPicker({
			color: '#'+$('#color7').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelector7 span').css('backgroundColor', '#' + hex);
				$('#color7').attr('value', hex);
			}
		});

        $('#colorSelectorApp1').ColorPicker({
			color: '#'+$('#colorApp1').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorApp1 span').css('backgroundColor', '#' + hex);
				$('#colorApp1').attr('value', hex);
			}
		});


        $('#colorSelectorApp2').ColorPicker({
			color: '#'+$('#colorApp2').val(),
			onShow: function (colpkr) {
				$(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				$(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				$('#colorSelectorApp2 span').css('backgroundColor', '#' + hex);
				$('#colorApp2').attr('value', hex);
			}
		});

	};
	
	var showTab = function(e) {
		var tabIndex = $('ul.navigationTabs a')
							.removeClass('active')
							.index(this);
		$(this)
			.addClass('active')
			.blur();
		$('div.tab')
			.hide()
				.eq(tabIndex)
				.show();
	};
	
	EYE.register(initLayout, 'init');
})(jQuery)