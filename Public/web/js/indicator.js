window.onload=function(){
	var oart=document.getElementById('article');
	var oul=oart.getElementsByTagName('ul');	
	var oindi=document.getElementById('indicator');
	var i=0;
	var k=oul.length;
	for(var l=1;l<=k;l++){
		oindi.innerHTML+='<li class="indicLi">'+l+'</li>'
	}
	oindi.innerHTML+='<li id="nex">下一页</li>';
	for(var j=0;j<k;j++){
		if(j>0){oul[j].style.display='none';};
	}
	var opre=document.getElementById('pre');
	var onex=document.getElementById('nex');
	var indiLi=oindi.getElementsByTagName('li');
	onex.onclick=function(){
		if (i<k-1) {
			oul[i].style.display='none';
			i++;
			oul[i].style.display='block';
		}
	}
	opre.onclick=function(){
		if (i>0) {
			oul[i].style.display='none';
			i--;
			oul[i].style.display='block';
		}
	}
	function msg(index){
		indiLi[index].onclick=function(){
			for(var num=1;num<=k;num++){
				if(num!=index){
					oul[num-1].style.display='none';
				}
				else{
					oul[num-1].style.display='block';
				}				
			}
			i=index-1;
		}
	}
	for(var ind=1;ind<=k;ind++){
		msg(ind);
	}
	msg=null;
	// for(var num=1;num<=k;num++){
	// 	indiLi[num].onclick=function(){
	// 		alert(num);
	// 	}
	// }
}