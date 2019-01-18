workflow "New workflow" {
  on = "push"
  resolves = ["composer"]
}

action "composer" {
  uses = "php:7.2-fpm"
  runs = "composer inst"
}
