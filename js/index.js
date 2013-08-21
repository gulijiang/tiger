;(function($,win){

	var proto = "prototype",len = "length";

	$.log = function(){
		win['console'] && win['console']['log'] && win['console']['log'](arguments[0]);
	}

	var ICON_CLS_MAP = {
		lion:"icon-lion",	//狮子
		rabbit:"icon-rabbit",	//兔子
		monkey:"icon-monkey",	//猴子
		panda:"icon-panda",	//熊猫
		eagle:"icon-eagle",	//老鹰
		peacock:"icon-peacock",	//孔雀
		prize:"icon-prize",	//大奖
		swallow:"icon-swallow",	//燕子
		"golden-shark":"icon-golden-shark",	//金鲨
		"silver-shark":"icon-silver-shark"	//银鲨
	};
		
	function SharkBattle(){
		this.init(arguments[0],arguments[1]);
	}

	$.extend(SharkBattle[proto],{
		init:function(container,cfg){
			var	self = this;

			self.cfg = $.extend({
				rownum:7,
				colnum:9
			},cfg);

			self.$container = $(container);

			if(!self.$container) return;

			$.log(self.cfg)


		},
		render:function(){
			var self = this;
			self.$container.html(self.__createDom());
			$.log(self.$container.find("li"))
		},
		__createDom:function(){
			var self = this,
				cfg = self.cfg,
				queue = cfg.queue,
				num = cfg.rownum * 2 + cfg.colnum * 2 - 4,
				width = self.$container.width(),
				height = self.$container.height(),
				cellwidth = Math.floor(width/cfg.colnum),
				cellheight = Math.floor(height/cfg.rownum),
				html = "<ul>",
				poslist = [];

			for(var i = 0;i < cfg.colnum;i++){
				poslist.push({x:i * cellwidth,y:0});
			}

			for(var i = 1;i < cfg.rownum - 1;i++){
				poslist.push({x:(cfg.colnum-1)*cellwidth,y: i * cellheight});
			}

			for(var i = cfg.colnum;i > 0;i--){
				poslist.push({x:(i-1) * cellwidth,y:(cfg.rownum - 1) * cellheight});
			}

			for(var i = cfg.rownum - 1;i > 1;i--){
				poslist.push({x:0,y:(i-1) * cellheight});
			}

			for(var i in poslist){
				var pos = poslist[i],className = ICON_CLS_MAP[queue[i]];
				html += "<li class='icon-item "+className+"'  style='margin-left:"+pos['x']+"px;margin-top:"+pos['y']+"px'></li>";
			}
			html += "</ul>";
			return html;
		}
	});

	var tm = new SharkBattle("#J_Screen",{
		queue:['silver-shark','eagle','eagle','eagle','golden-shark','lion','lion','lion','silver-shark'
			,'panda','panda','golden-shark','monkey','monkey'
			,'silver-shark','rabbit','rabbit','rabbit','golden-shark','swallow','swallow','swallow','silver-shark'
			,'silver-shark','rabbit','rabbit','rabbit','golden-shark',
		]
	});
	tm.render();

})(jQuery,this)