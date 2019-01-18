workflow "New workflow" {
  on = "push"
  resolves = ["composer"]
}

action "composer" {
  uses = "composer"
  runs = "composer inst"
}
