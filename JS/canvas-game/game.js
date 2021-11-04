const canvas = document.querySelector("canvas"); // Plateau
const c = canvas.getContext("2d"); // Context

canvas.width = innerWidth;
canvas.height = innerHeight;
const scoreEl = document.getElementById("scoreEl");
const startGameBtn = document.getElementById("startGameBtn");
const modalEl = document.getElementById("modalEl");
const bigScoreEl = document.getElementById("bigScoreEl");
const PLAYER_COLOR = "white";
const PLAYER_SIZE = 10;
const PROJECTILE_COLOR = "white";
const PROJECTILE_SIZE = 5;
const PROJECTILE_SPEED = 5;
const ENEMY_SPEED = 2;
const EXPLOSION_SPEED = 0.99;

class Player {
  constructor(x, y, radius, color) {
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.color = color;
  }
  draw() {
    // Insertion du joueur dans le canvas
    c.beginPath();
    c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false); // Définir la position
    c.fillStyle = this.color;
    c.fill();
  }
}

class Projectile {
  constructor(x, y, radius, color, velocity) {
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.color = color;
    this.velocity = velocity;
  }
  draw() {
    // Insertion du projectile dans le canvas
    c.beginPath();
    c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false); // Définir la position
    c.fillStyle = this.color;
    c.fill();
  }

  update() {
    this.draw();
    this.x = this.x + this.velocity.x;
    this.y = this.y + this.velocity.y;
  }
}

class Enemy {
  constructor(x, y, radius, color, velocity) {
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.color = color;
    this.velocity = velocity;
  }
  draw() {
    // Insertion du projectile dans le canvas
    c.beginPath();
    c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false); // Définir la position
    c.fillStyle = this.color;
    c.fill();
  }

  update() {
    this.draw();
    this.x = this.x + this.velocity.x;
    this.y = this.y + this.velocity.y;
  }
}

class Particle {
  constructor(x, y, radius, color, velocity) {
    this.x = x;
    this.y = y;
    this.radius = radius;
    this.color = color;
    this.velocity = velocity;
    this.alpha = 1;
  }
  draw() {
    // Insertion du projectile dans le canvas
    c.save();
    c.globalAlpha = this.alpha;
    c.beginPath();
    c.arc(this.x, this.y, this.radius, 0, Math.PI * 2, false); // Définir la position
    c.fillStyle = this.color;
    c.fill();
    c.restore();
  }

  update() {
    this.draw();
    this.velocity.x *= EXPLOSION_SPEED;
    this.velocity.y *= EXPLOSION_SPEED;
    this.x = this.x + this.velocity.x;
    this.y = this.y + this.velocity.y;
    this.alpha -= 0.01;
  }
}

const x = canvas.width / 2;
const y = canvas.height / 2;
let player = new Player(x, y, PLAYER_SIZE, PLAYER_COLOR);
let projectiles = [];
let enemies = [];
let particles = [];
let animationId;
let score = 0;
scoreEl.innerHTML = score;

function init() {
  player = new Player(x, y, PLAYER_SIZE, PLAYER_COLOR);
  projectiles = [];
  enemies = [];
  particles = [];
  score = 0;
  scoreEl.innerHTML = score;
  bigScoreEl.innerHTML = score;
}

// SPWAN ENEMIES
function spawnEnemies() {
  setInterval(() => {
    const radius = Math.random() * (30 - 5) + 5;

    let x;
    let y;

    if (Math.random() < 0.5) {
      x = Math.random() < 0.5 ? 0 - radius : canvas.width + radius;
      y = Math.random() * canvas.height;
    } else {
      x = Math.random() * canvas.width;
      y = Math.random() < 0.5 ? 0 - radius : canvas.height + radius;
    }
    const color = `hsl(${Math.random() * 360}, 50%, 50%)`;
    const angle = Math.atan2(
      // calcul de l'angle du centre par rapport au click de la souris
      canvas.height / 2 - y,
      canvas.width / 2 - x
    );
    const velocity = {
      x: Math.cos(angle) * ENEMY_SPEED,
      y: Math.sin(angle) * ENEMY_SPEED,
    };
    enemies.push(new Enemy(x, y, radius, color, velocity));
  }, 1000);
}

// ANNIMATION
function animate() {
  animationId = requestAnimationFrame(animate);
  c.fillStyle = "rgba(0,0,0,0.3)";
  c.fillRect(0, 0, canvas.width, canvas.height);
  player.draw();
  particles.forEach((particle, index) => {
    if (particle.alpha <= 0) {
      particles.splice(index, 1);
    } else {
      particle.update();
    }
  });
  projectiles.forEach((projectile, index) => {
    projectile.update();

    if (
      projectile.x + projectile.radius < 0 ||
      projectile.x - projectile.radius > canvas.width ||
      projectile.y + projectile.radius < 0 ||
      projectile.y - projectile.raduis > canvas.height
    ) {
      setTimeout(() => {
        projectiles.splice(index, 1);
      }, 0);
    }
  });
  enemies.forEach((enemy, index) => {
    enemy.update();
    // si le joueur est touché fin de partie
    const dist = Math.hypot(player.x - enemy.x, player.y - enemy.y);
    if (dist - enemy.radius - player.radius < 1) {
      cancelAnimationFrame(animationId);
      bigScoreEl.innerHTML = score;
      modalEl.style.display = "flex";
    }

    projectiles.forEach((projectile, projectileIndex) => {
      const dist = Math.hypot(projectile.x - enemy.x, projectile.y - enemy.y);
      // SI projectile touche un ennemi
      if (dist - enemy.radius - projectile.radius < 1) {
        // Explosion
        for (let i = 0; i < enemy.radius * 2; i++) {
          particles.push(
            new Particle(
              projectile.x,
              projectile.y,
              Math.random() * 2,
              enemy.color,
              {
                x: (Math.random() - 0.5) * (Math.random() * 5),
                y: (Math.random() - 0.5) * (Math.random() * 5),
              }
            )
          );
        }
        if (enemy.radius - 10 > 5) {
          //Augmentation du score
          score += 100;
          scoreEl.innerHTML = score;

          gsap.to(enemy, { radius: enemy.radius - 10 });
          setTimeout(() => {
            projectiles.splice(projectileIndex, 1);
          }, 0);
        } else {
          //Augmentation du score
          score += 250;
          scoreEl.innerHTML = score;
          // Supprime l'ennemi du canvas
          setTimeout(() => {
            enemies.splice(index, 1);
            projectiles.splice(projectileIndex, 1);
          }, 0);
        }
      }
    });
  });
}

addEventListener("click", (event) => {
  const angle = Math.atan2(
    // calcul de l'angle du centre par rapport au click de la souris
    event.clientY - y,
    event.clientX - x
  );
  const velocity = {
    x: Math.cos(angle) * PROJECTILE_SPEED,
    y: Math.sin(angle) * PROJECTILE_SPEED,
  };
  projectiles.push(
    new Projectile(x, y, PROJECTILE_SIZE, PROJECTILE_COLOR, velocity)
  );
});

startGameBtn.addEventListener("click", () => {
  init();
  animate();
  spawnEnemies();
  modalEl.style.display = "none";
});
