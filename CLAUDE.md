# CLAUDE.md — IronCore implementation contract

**Read first:** `docs/PROJECT_STATE.md`; then only the specific section of `docs/content.md` needed for the requested task, plus `docs/page-blueprint.md`, `docs/design-system.md`, `docs/design-rules.md`. Historical files in `docs/archive/` are NEVER authoritative. **Do not write code until the current visual direction / logo are approved** or user explicitly authorizes a temporary scaffold.

## Roles and scope
ChatGPT + user approve the structure/visual direction. Claude implements; do not invent redesigns, new sections, descriptions, icons, labels, sample clients or engineering figures. Preserve 11 required sections and exact technical values. Demo HTML/CSS/JS, then WordPress handoff; not WordPress integration in this repo.

## Build constraints
- Prefer simple semantic HTML + modular CSS + small vanilla JS; no framework/build step unless expressly instructed.
- Code and content in Russian, accessible markup; IDs as in docs/page-blueprint.md.
- Desktop/mobile support at 360, 390, 768, 1024, 1440 px.
- Functional header navigation, menus, accordions, tabs, modal; keyboard and touch access, focus-visible, reduced motion.
- Do not claim real CRM/Telegram submission or PDF downloads without backend/files. Use clearly marked demo states.
- Source visual assets from `assets/`; if missing, flag explicitly. No watermarked copyrighted stock or unsupported HTML scenes.
- No generic AI design: see `docs/design-rules.md`.
- Preserve exact copy and numerical data from `docs/content.md`.

## Token/cost discipline
- At chat start read **only** `README.md`, `docs/PROJECT_STATE.md`, and files relevant to the assigned step. Never rescan all 24 screenshots when text already exists.
- Work in one small chunk; edit only affected components. Avoid package installs, mass refactors, duplicate documentation, full source reprints and unnecessary browser screenshot runs unless needed for QA.
- One task per chat; commit + push only actual results, then update `docs/PROJECT_STATE.md` with next action. Do not claim a successful push unless confirmed.

## Handoff at chat end
Give (1) what changed (2–3 lines), (2) link to commit/repo, (3) status of demo and anything nonfunctional, (4) exact first message for the next chat.
Repository: https://github.com/d1trepes/ironcore-website
