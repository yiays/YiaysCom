// Check for mouse movement
hasmouse = null;
$(window).one('mousemove',function(){if(hasmouse === null) hasmouse=true}).one('touchstart',function(){if (hasmouse===null) hasmouse=false});

$('.pfp').on('click', function(){
	$('.floaty').toggleClass("show");
	if($('.floaty').is('.show'))
		window.location.hash = '#/main';
	else
		history.pushState("", document.title, window.location.pathname);
});

$(document).ready(function(){
	loadpage(window.location.hash);
	
	$.ajax({
		url: "https://api.github.com/users/yiays/events",
		method: "GET",
		success: function(data){
			created = [];
			$('#commitsloading').remove();
			data.forEach(function(ev){
				if(ev.type == "PushEvent"){
					var notes = "";
					ev.payload.commits.forEach(function(commit){
						if(commit.author.email == 'yesiateyoursheep@gmail.com'){
							var message = commit.message.split('\n');
							var extra = message.filter((e) => {return e != ""}).slice(1).join('<br>');
							if(extra) notes += '<li>'+message[0] + '<input type="checkbox" class="extratoggle"/><span class="extra">' + extra + '</span></li>';
							else notes += '<li>'+commit.message+'</li>';
						}
					});
					if(notes.length){
						//$('#commits').append('<li>'+ev.created_at+'</td><td>'+ev.repo.name+'</td><td>Commit#'+ev.payload.head.substring(0,7)+'</td><td>'+ev.payload.commits[0].message+'</li>');
						// Comitted <a href="">#3deac40</a> to <a href>yiays/merely</a>: Fix m/die easter egg <i class="dim">- 3 days ago</i>
						$('#commits').append('<li class="event">'+
																		 '<img alt="commit" src="/img/oct/git-commit.svg">'+
																		 '<b>Committed <a href="https://github.com/'+ev.repo.name+'/commit/'+ev.payload.head+'">#'+ev.payload.head.substring(0,7)+'</a>'+
																		 ' to <a href="https://github.com/'+ev.repo.name+'">'+ev.repo.name+':'+ev.payload.ref.substring(11)+'</a></b><br>'+
																		 '<ul>'+notes+'</ul><i class="dim">'+date_fold(new Date(ev.created_at))+'</i>'+
																		 '</li>'
						);
					}
				}
				else if(ev.type == "ForkEvent"){
					$('#commits').append('<li class="event"><img alt="fork" src="/img/oct/repo-forked.svg"><b>Forked <a href="https://github.com/'+ev.repo.name+'">'+ev.repo.name+'</a> to <a href="https://github.com/'+ev.payload.forkee.full_name+'">'+ev.payload.forkee.full_name+'</a></b><ul><li>'+ev.payload.forkee.description+'</li></ul><i class="dim">'+date_fold(new Date(ev.created_at))+'</i></li>');
				}
				else if(ev.type == "CreateEvent"){
					if(created.indexOf(ev.repo.name)==-1){
						$('#commits').append('<li class="event"><img alt="repo create" src="/img/oct/repo.svg"><b>Created <a href="https://github.com/'+ev.repo.name+'">'+ev.repo.name+'</a></b><ul><li>'+ev.payload.description+'</li></ul><i class="dim">'+date_fold(new Date(ev.created_at))+'</i></li>');
						created.push(ev.repo.name);
					}
				}
				else if(ev.type == "PullRequestEvent"){
					$('#commits').append('<li class="event"><img alt="fork" src="/img/oct/repo-pull.svg"><b>'+ev.payload.action[0].toUpperCase()+ev.payload.action.slice(1)+' a <a href="'+ev.payload.pull_request.html_url+'">pull request</a> in <a href="https://github.com/'+ev.repo.name+'">'+ev.repo.name+'</a></b><ul><li>'+ev.payload.pull_request.title+'</li></ul><i class="dim">'+date_fold(new Date(ev.created_at))+'</i></li>');
				}
			});
		},
		error: function(){
			$('#commitsloading').remove();
			$('#commits').html('<li class="event" style="color: red;">Failed to fetch data from GitHub!</li>');
		}
	});

	$.ajax({
		url: 'https://blog.yiays.com/api/posts/',
		method: 'GET',
		success: function(posts){
			$('#postsloading').remove();
			if(posts){
				posts.forEach(function(post){
					$('#posts').append('<li class="event"><a href="https://blog.yiays.com/'+post.Url+'"><b>'+post.Title+'</b></a><br>'+
															'<div>'+post.Preview+'</div>'+
															'<i class="dim">'+date_fold(new Date(post.Date))+'</i></li>');
				});
			}else{
				$('#posts').html('<li class="event" style="color: red;">Failed to fetch blog posts!</li>');
			}
		},
		error: function(){
			$('#postsloading').remove();
			$('#posts').html('<li class="event" style="color: red;">Failed to fetch blog posts!</li>');
		}
	});
});

$(window).bind('hashchange', function() {
  loadpage(window.location.hash);
});

function loadpage(hash){
	if(hash.startsWith('#/activity')){
		$('.floaty').addClass('show');
		$('.cardpage').addClass('hidden');
		$('#activity').removeClass('hidden');
		if(hash.startsWith('#/activity/github')){
			$('.activity-feed').addClass('hidden');
			$('#commits').removeClass('hidden');
			$('#activity .nav-link.active').removeClass('active');
			$('#activity .nav-link[href="#/activity/github"]').addClass('active');
		}else if(hash.startsWith('#/activity/blog')){
			$('.activity-feed').addClass('hidden');
			$('#posts').removeClass('hidden');
			$('#activity .nav-link.active').removeClass('active');
			$('#activity .nav-link[href="#/activity/blog"]').addClass('active');
		}
	}else if(hash.startsWith('#/portfolio')){
		$('.floaty').addClass('show');
		$('.cardpage').addClass('hidden');
		$('#portfolio').removeClass('hidden');
		var lang = hash.split('/', 3)[2];
		if(lang){
			$('.lang.active').removeClass('active');
			$(".lang[href='#/portfolio/"+lang+"']").addClass('active');
			$('.project').addClass('hidden');
			$('.project[data-langs~="'+lang+'"]').removeClass('hidden');
		}else{
			$('.lang.active').removeClass('active');
			$(".lang[href='#/portfolio']").addClass('active');
			$('.project.hidden').removeClass('hidden');
		}
	}else if(hash.startsWith('#/main')){
		$('.floaty').addClass('show');
		$('.cardpage').addClass('hidden');
		$('#main').removeClass('hidden');
	}else{
		$('.floaty').removeClass('show');
		$('.cardpage').addClass('hidden');
		$('#main').removeClass('hidden');
	}
}

hoverproject = null;
hoverprojecttimer = null;
$('.project').hover(
	function(e){
		hoverprojecttimer = setTimeout(function(){
			hoverproject = $(e.target).closest('.project').attr('id');
		},500)},
	function(e){
		clearTimeout(hoverprojecttimer);
		hoverproject = null;
	}
);
$('.project').on('click',function(e){
	if(!hasmouse && $(e.target).closest('.project').attr('id') != hoverproject){
		e.preventDefault();
		return false;
	}
});

function date_fold(time){
	var secondsSince = Math.round(Math.abs(new Date() - time) / 1000);
	if(secondsSince==0) return 'just now';
	var past = (secondsSince > 0);
	if(secondsSince >= 60){
		var minutesSince = Math.round(secondsSince / 60);
		if(minutesSince >= 60){
			var hoursSince = Math.round(minutesSince / 60);
			if(hoursSince >= 24){
				var daysSince = Math.round(hoursSince / 24);
				if(daysSince >= 30){
					var monthsSince = Math.round(daysSince / 30);
					if(daysSince >= 365){
						var yearsSince = Math.round(daysSince / 365);
						return yearsSince + ' year' + (yearsSince==1?'':'s') + ' ' + (past?'ago':'in the future');
					}
					return monthsSince + ' month' + (monthsSince==1?'':'s') + ' ' + (past?'ago':'in the future');
				}
				return daysSince + ' day' + (daysSince==1?'':'s') + ' ' + (past?'ago':'in the future');
			}
			return hoursSince + ' hour' + (hoursSince==1?'':'s') + ' ' + (past?'ago':'in the future');
		}
		return minutesSince + ' minute' + (minutesSince==1?'':'s') + ' ' + (past?'ago':'in the future');
	}
	return secondsSince + ' second' + (secondsSince==1?'':'s') + ' ' + (past?'ago':'in the future');
}