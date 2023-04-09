Game.Preloader = function(game) {
	
};

Game.Preloader.prototype = {
	preload: function() {
		this.preloadbar = this.add.sprite(this.world.centerX - 70, this.world.centerY - 10, 'preloaderBar');
		
		this.add.sprite(this.world.centerX, this.world.centerY, 'preloaderFrame').anchor.setTo(0.5, 0.5);
		
		this.load.setPreloadSprite(this.preloadbar);
		
		this.load.bitmapFont('bignumbers', 'font/bignumbers.png', 'font/bignumbers.xml');
		this.load.bitmapFont('smallnumbers', 'font/smallnumbers.png', 'font/smallnumbers.xml');
		
		this.load.spritesheet('bird', 'image/bird.png', 58, 40);
		this.load.spritesheet('city', 'image/city.png', 489, 157);
		this.load.spritesheet('pipes', 'image/pipes.png', 85, 500);
		
		this.load.image('flappybird', 'image/flappybird.png');
		this.load.image('gameover', 'image/gameover.png');
		this.load.image('getready', 'image/getready.png');
		this.load.image('ground', 'image/ground.png');
		this.load.image('medal', 'image/medal.png');
		this.load.image('new', 'image/new.png');
		this.load.image('playbutton', 'image/playbutton.png');
		this.load.image('scoreboard', 'image/scoreboard.png');
		this.load.image('stars', 'image/stars.png');
		this.load.image('tap', 'image/tap.png');
		
		this.load.audio('jump', 'audio/jump.wav');
		this.load.audio('score', 'audio/score.wav');
		this.load.audio('hit', 'audio/hit.wav');
	},
	create: function() {
		this.preloadbar.cropEnabled = false;
	},
	update: function() {
		if (this.cache.isSoundDecoded('jump') && this.cache.isSoundDecoded('score') && this.cache.isSoundDecoded('hit')) {
			this.state.start('Play');
		}
	},
};