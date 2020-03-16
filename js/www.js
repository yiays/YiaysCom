$(document).ready(function(){
	$.ajax({
		url: "https://api.github.com/users/yiays/events",
		method: "GET",
		success: function(data){
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
						$('#commits>div').append('<li class="event">'+
																	'<b>Committed <a href="https://github.com/'+ev.repo.name+'/commit/'+ev.payload.head+'">#'+ev.payload.head.substring(0,7)+'</a>'+
																	' to <a href="https://github.com/'+ev.repo.name+'">'+ev.repo.name+'</a></b><br>'+
																	'<ul>'+notes+'</ul><i class="dim">'+date_fold(new Date(ev.created_at))+'</i>'+
																	'</li>'
						);
					}
				}
				else if(ev.type == "ForkEvent"){
					$('#commits>div').append('<li class="event"><b>Forked <a href="https://github.com/'+ev.repo.name+'">'+ev.repo.name+'</a> to <a href="https://github.com/'+ev.payload.forkee.full_name+'">'+ev.payload.forkee.full_name+' </a></b><br><i class="dim">'+date_fold(new Date(ev.created_at))+'</i></li>');
				}
				else if(ev.type == "CreateEvent"){
					$('#commits>div').append('<li class="event"><b>Created <a href="https://github.com/'+ev.repo.name+'">'+ev.repo.name+'</a></b><br>'+ev.payload.description+'<br><i class="dim">'+date_fold(new Date(ev.created_at))+'</i></li>');
				}
				else if(ev.type == "PullRequestEvent"){
					//$('#commits').append('<li class="event"><b>Created a pull request <a href="https://github.com/'+ev.repo.name+'">'+ev.repo.name+'</a> to <a href="https://github.com/'+ev.payload.forkee.full_name+'">'+ev.payload.forkee.full_name+' </a></b><br><i class="dim">'+date_fold(new Date(ev.created_at))+'</i></li>');
				}
			});
		},
		error: function(){
			$('#commitsloading').remove();
			$('#commits').html('<li class="event" style="color: red;">Failed to fetch data from GitHub!</li>');
		}
	});

	$.ajax({
		url: 'https://blog.yiays.com/api/blog.php?q=posts',
		method: 'GET',
		success: function(data){
			$('#postsloading').remove();
			if(data.status){
				for(var id in data.result){
					var post = data.result[id];
					var content = post.Content.substring(0,128).replace(/<.*?>/g,'');
					if(content.lastIndexOf('<')>=0) content=content.substring(0,content.lastIndexOf('<'));
					$('#posts>div').prepend('<li class="event"><a href="https://blog.yiays.com/'+post.url+'"><b>'+post.Title+'</b></a><br>'+
																 '<div>'+content+'...</div>'+
																 '<i class="dim">'+date_fold(new Date(post.Date))+'</i></li>');
				}
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

$('.langtable td').on('click',function(e){
	e.preventDefault();
	$('.langtable td.active').removeClass('active');
	$(this).addClass('active');
	$('#refresh-projects.hide').removeClass('hide');
	$('.project').addClass('hide');
	$('.project[data-langs~="'+$(this).find('.lang').attr('data-lang')+'"]').removeClass('hide');
	return false;
});
$('#refresh-projects').on('click',function(e){
	e.preventDefault();
	$('.langtable td.active').removeClass('active');
	$('.project.hide').removeClass('hide');
	$(this).addClass('hide');
	return false;
});

$('header>a').on('click',function(e){
	e.preventDefault();
	$('header>a').removeClass('active');
	$(this).addClass('active');
	$('.gradient-1').removeClass('blue purple');
	$('.gradient-1').addClass($(this).data('colour'));
	return false;
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