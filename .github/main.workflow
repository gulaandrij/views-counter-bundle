workflow "New workflow" {
  on = "push"
  resolves = ["composer"]
}

action "composer" {
  uses = "_/php"
  runs = "composer inst"
}
