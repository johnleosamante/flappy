Game.Play = function(game) {

};

Game.Play.prototype = {
	create: function() {
		this.waitingForFirstClick = true;
		this.movePipes = false;
		this.gameover = false;
		this.score = -1;
		
		this.physics.startSystem(Phaser.Physics.ARCADE);
		
		this.createBackground();
		
		this.pipes = this.add.group();
		
		this.frame = Math.floor(Math.random() * 3) * 4;
		
		this.createGround();
		
		if (Game.firstRun) {
			this.createTitleScreen();
			this.createBird(this.world.centerX, 380, this.frame, true, 8);
		} else {
			this.createScoreText();
			this.createInstructionScreen();
			this.createBird(160, 440, this.frame, true, 8);
			this.createControls();
		}
		
		this.createSounds();
		
		var hiScore = Storage.get("fbhighscore");
		if (hiScore) {
			Game.highScore = hiScore;
		}
	},
	update: function() {		
		if (!this.gameover) {
			this.bird.animations.play('flap');
			this.ground.tilePosition.x -= 3;
		}
		
		if (this.waitingForFirstClick) {
			this.bird.y -= 1;
		} else {
			if (!this.gameover) {
				if (this.bird.angle < 30) {
					this.bird.angle += 2;
				}
			} else {
				if (this.bird.angle < 90) {
					this.bird.angle += 45;
				}
			}
		}
		
		this.physics.arcade.overlap(this.bird, this.pipes, this.hit, null, this);
		
		this.physics.arcade.collide(this.bird, this.ground, this.hit, null, this);
	},
	createBackground: function() {
		var time = Math.floor(Math.random() * 2);
		if (time === 0) {
			this.game.stage.backgroundColor = "#4ec0ca";
			this.add.sprite(0, this.world.height - 347, 'city').frame = 0;
		} else {
			this.game.stage.backgroundColor = "#008793";
			this.add.sprite(0, this.world.height - 347, 'city').frame = 1;
			this.add.sprite(this.world.centerX, 207, 'stars').anchor.setTo(0.5, 0);
		}
	},
	createBird: function(x, y, frame, fly, rate) {
		this.bird = this.add.sprite(x, y, 'bird');
		this.bird.anchor.setTo(0.6, 0.6);
		
		this.bird.animations.add('flap', [0 + frame, 1 + frame, 2 + frame], rate, true);
		
		this.physics.arcade.enable(this.bird);
		
		if (fly) {
			this.add.tween(this.bird).to({y: y - 10}, 500, Phaser.Easing.Linear.None, true, 0, 500, true);
		} else {
			this.bird.body.gravity.y = 1500;
			this.bird.body.collideWorldBounds = true;
		}
	},
	createGround: function() {
		this.ground = this.add.tileSprite(0, this.world.height - 190, 489, 190, 'ground');
		this.physics.arcade.enable(this.ground);
		this.ground.body.immovable = true;
	},
	createTitleScreen: function() {
		this.titleScreen = this.add.group();
		
		this.playButton = this.add.button(this.world.centerX, 555, 'playbutton', this.playButtonClicked, this, 2, 1, 0);
		this.playButton.anchor.setTo(0.5, 0);
		
		this.titleScreen.create(this.world.centerX, 255, 'flappybird').anchor.setTo(0.5, 0);
		this.titleScreen.add(this.playButton);
	},
	createScoreText: function() {
		this.scoreText = this.add.bitmapText(this.world.centerX, 140, 'bignumbers', '0', 50);
        this.scoreText.anchor.setTo(0.5, 0);
	},
	createInstructionScreen: function() {
		this.instructionScreen = this.add.group();
		this.instructionScreen.create(this.world.centerX, 250, 'getready').anchor.setTo(0.5, 0);
		this.instructionScreen.create(this.world.centerX, 370, 'tap').anchor.setTo(0.5, 0);
	},
	createGameOverScreen: function() {
		this.scoreText.destroy();
		
		this.gameOverScreen = this.add.group();
		
		this.gameOverScreen.create(this.world.centerX, 220, 'gameover').anchor.setTo(0.5, 0);
		this.gameOverScreen.create(this.world.centerX, 330, 'scoreboard').anchor.setTo(0.5, 0);
		
		if (this.score > Game.highScore) {
			Storage.set("fbhighscore", this.score);
			Game.highScore = this.score;
			this.gameOverScreen.create(this.world.width - 152, 430, 'new').anchor.setTo(1, 0);
		}
		
		if (this.score >= 10) {
			this.gameOverScreen.create(96 , 403, 'medal');
		}
		
		if (this.score <= 0) {
			this.score = "0";
		}
		
		var s = this.add.bitmapText(this.world.width - 88, 388, 'smallnumbers', this.score, 33);
		s.anchor.setTo(1, 0);
        
		var num;
        if (Game.highScore < 1) {
            num = "0";
        } else {
            num = Game.highScore;
        }
        
		var hs = this.add.bitmapText(this.world.width - 88, 458, 'smallnumbers', num, 33);
		hs.anchor.setTo(1, 0);
		
		this.playButton = this.add.button(this.world.centerX, 555, 'playbutton', this.playButtonClicked, this, 2, 1, 0);
		this.playButton.anchor.setTo(0.5, 0);
		
		this.gameOverScreen.add(s);
		this.gameOverScreen.add(hs);
		this.gameOverScreen.add(this.playButton);
	},
	createSounds: function() {
		this.jumpSound = this.add.audio('jump');
		this.scoreSound = this.add.audio('score');
		this.hitSound = this.add.audio('hit');
	},
	createControls: function() {
		this.spaceKey = this.input.keyboard.addKey(Phaser.Keyboard.SPACEBAR);
		this.spaceKey.onDown.add(this.inputHandler, this);
		this.input.onDown.add(this.inputHandler, this);
	},
	jump: function() {
		this.bird.body.velocity.y = -450;
		
		this.add.tween(this.bird).to({angle: -30}, 100).start();
		
		this.jumpSound.play();
	},
	inputHandler: function() {
		if (this.waitingForFirstClick) {
			this.waitingForFirstClick = false;
			this.world.remove(this.instructionScreen);
			
			this.bird.kill();
			this.createBird(150, 430, this.frame, false, 16);
			
			this.timer = this.time.events.loop(1800, this.addThePipes, this);
		}
			
		if (!this.gameover) {
			this.jump();
		}
	},
	hit: function() {
		if (this.gameover) {
			return;
		}
		
		this.hitSound.play();
		
		this.time.events.remove(this.timer);
		
		this.bird.animations.stop();
		this.bird.frame = this.frame + 3;
		
		this.pipes.forEach(function(p) {
			p.body.velocity.x = 0;
		}, this);
		
		this.gameover = true;
		
		this.createGameOverScreen();
	},
	addOnePipe: function(x, y, frame) {
		var pipe = this.add.sprite(x, y, 'pipes');
		pipe.frame = frame;
		this.pipes.add(pipe);
		this.physics.arcade.enable(pipe);
		
		pipe.body.velocity.x = -200;
		pipe.checkWorldBounds = true;
		pipe.outOfBoundsKill = true;
	},
	addThePipes: function() {
		var pipePosition = Math.floor(Math.random() * 9) + 1;
		
		this.addOnePipe(489, -(pipePosition * 50) + 10, 0);
		this.addOnePipe(489, -(pipePosition * 50) + 675, 1);
		
		this.score += 1;
		if (this.score > 0) {
			this.scoreText.text = this.score;
			this.scoreSound.play();
		}
	},
	playButtonClicked: function() {
		if (Game.firstRun) {
			this.playButton.kill();
			this.titleScreen.destroy();
			Game.firstRun = false;
			
			this.bird.kill();
			this.createBird(160, 440, this.frame, true, 8);
			
			this.createControls();
			this.createScoreText();
			this.createInstructionScreen();
		}
		
		if (this.gameover) {
			this.waitingForFirstClick = true;
			this.state.start('Play');
		}
	},
};